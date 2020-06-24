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

namespace ApiPlatform\ActivityPub\Action;

use ApiPlatform\ActivityPub\ActivityRepository;
use ApiPlatform\ActivityPub\Publish;
use ApiPlatform\ActivityPub\Serializer\CollectionNormalizer;
use ApiPlatform\ActivityPub\Serializer\InboxOutboxDenormalizer;
use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class Outbox
{
    private Publish $publish;
    private SerializerInterface $serializer;
    private ItemDataProviderInterface $itemDataProvider;
    private IriConverterInterface $iriConverter;
    private ActivityRepository $activityRepository;
    private string $personType;

    public function __construct(Publish $publish, SerializerInterface $serializer, ItemDataProviderInterface $itemDataProvider, IriConverterInterface $iriConverter, ActivityRepository $activityRepository, string $personType = Person::class)
    {
        $this->publish = $publish;
        $this->serializer = $serializer;
        $this->itemDataProvider = $itemDataProvider;
        $this->iriConverter = $iriConverter;
        $this->activityRepository = $activityRepository;
        $this->personType = $personType;
    }

    public function __invoke(Request $request): JsonResponse
    {
        if (
            (null === $personId = $request->attributes->get('personId')) ||
            null === $person = $this->itemDataProvider->getItem($this->personType, $personId)
        ) {
            throw new NotFoundHttpException(sprintf('Person "%s" not found.', $personId));
        }

        if ($request->isMethod('POST')) {
            return $this->handlePost($request, $person);
        }

        $activities = $this->activityRepository->getActivitiesOf($this->iriConverter->getIriFromItem($person));
        $json = $this->serializer->normalize($activities, CollectionNormalizer::FORMAT, ['skip_null_values' => true]);

        return new JsonResponse($json, 200, [
            'Content-Type' => 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"',
        ]);
    }

    private function handlePost(Request $request, Person $person): JsonResponse
    {
        // TODO: validate the request using JSON Schema: https://github.com/redaktor/ActivityPubSchema
        try {
            $object = $this->serializer->deserialize($request->getContent(), InboxOutboxDenormalizer::TYPE, 'jsonld');
        } catch (ExceptionInterface $e) {
            throw new BadRequestHttpException('Invalid JSON', $e);
        }

        $json = ($this->publish)($person, $object);

        return new JsonResponse(
            $json,
            200,
            [
                'Content-Type' => 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"',
                'Location' => $json['id'],
            ],
        );
    }
}
