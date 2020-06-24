<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <kevin@dunglas.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\ActivityPub;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Api\UrlGeneratorInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Activity;
use App\Entity\Create;
use App\Entity\Object_;
use App\Entity\Person;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Persists activities sent to the outbox and dispatch them to remote servers..
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class Publish
{
    private const RECIPIENT_TYPES = ['To', 'Bto', 'Cc', 'Bcc'];

    private IriConverterInterface $iriConverter;
    private DataPersisterInterface $dataPersister;
    private SerializerInterface $serializer;
    private HttpClientInterface $httpClient;
    private LoggerInterface $logger;
    private string $activityType;
    private string $createType;
    private HttpOptions $baseHttpOptions;

    public function __construct(IriConverterInterface $iriConverter, DataPersisterInterface $dataPersister, SerializerInterface $serializer, HttpClientInterface $httpClient, LoggerInterface $logger, string $activityType = Activity::class, string $createType = Create::class)
    {
        $this->iriConverter = $iriConverter;
        $this->dataPersister = $dataPersister;
        $this->serializer = $serializer;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->activityType = $activityType;
        $this->createType = $createType;

        $this->baseHttpOptions = (new HttpOptions())
            ->setHeaders(['Accept' => 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"']);
    }

    /**
     * @param Person           $person
     * @param Activity|Object_ $payload
     */
    public function __invoke(object $person, object $payload): array
    {
        $this->dataPersister->persist($payload);

        $activity = $payload;
        $object = null;
        if (!is_a($payload, $this->activityType)) {
            $object = $payload;

            $createType = $this->createType;
            /**
             * @var Create $activity
             */
            $activity = new $createType();
            $this->copyRecipients($object, $activity);

            $activity->setObject($this->iriConverter->getIriFromItem($object));
        }
        $activity->setActor($this->iriConverter->getIriFromItem($person, UrlGeneratorInterface::ABS_URL));
        $this->dataPersister->persist($activity);

        return $this->post($activity, $object);
    }

    /**
     * @param Object_|Activity $from
     * @param Object_|Activity $to
     */
    private function copyRecipients(object $from, object $to): void
    {
        foreach (self::RECIPIENT_TYPES as $type) {
            foreach (array_unique($from->{"get$type"}() ?? []) as $actor) {
                $to->{"add$type"}($actor);
            }
        }
    }

    /**
     * @param Activity     $activity
     * @param Object_|null $object
     */
    private function post(object $activity, ?object $object = null): array
    {
        $activityJson = $this->serializer->normalize($activity, 'jsonld', ['skip_null_values' => true]);
        if (null !== $object) {
            $objectJson = $this->serializer->normalize($object, 'jsonld', ['skip_null_values' => true]);
            $activityJson['object'] = $objectJson;
            unset($activityJson['object']['context']);
        }

        foreach ($this->resolveInboxes($activity) as $type => $inboxes) {
            foreach ($inboxes as $inbox) {
                // TODO: do this asynchronously using symfony/messenger, and support retry
                try {
                    $this->httpClient->request(
                        'POST',
                        $inbox,
                        $this->baseHttpOptions->setJson($activityJson)->toArray()
                    )->getStatusCode();
                } catch (\Exception $e) {
                    $this->logger->info('Unable to post to the inbox "{inbox}".', ['inbox' => $inbox, 'exception' => $e]);
                }
            }
        }

        return $activityJson;
    }

    /**
     * @param Activity $activity
     */
    private function resolveInboxes(object $activity): array
    {
        $inboxes = [];
        foreach (self::RECIPIENT_TYPES as $type) {
            foreach (array_unique($activity->{"get$type"}() ?? []) as $actor) {
                if ('https://www.w3.org/ns/activitystreams#Public' === $actor || 'as:Public' === $actor) {
                    // Skip public
                    continue;
                }

                // TODO: handle collections
                try {
                    $inboxes[$type][] = $this->getInboxUrl($actor);
                } catch (\Exception $e) {
                    $this->logger->info('Unable to resolve inbox for "{actor}".', ['actor' => $actor, 'exception' => $e]);
                }
            }

            $inboxes[$type] = array_unique($inboxes[$type] ?? []);
        }

        return $inboxes;
    }

    private function getInboxUrl(string $actorUrl): string
    {
        $actor = $this->httpClient
            ->request('GET', $actorUrl, $this->baseHttpOptions->toArray())
            ->toArray();

        if (!isset($actor['inbox'])) {
            throw new \RuntimeException(sprintf('Unable to find the inbox of actor "%s".', $actorUrl));
        }

        return $actor['inbox'];
    }
}
