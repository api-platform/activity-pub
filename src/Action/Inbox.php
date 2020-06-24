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
use ApiPlatform\ActivityPub\Persist;
use ApiPlatform\ActivityPub\Serializer\CollectionNormalizer;
use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class Inbox
{
    private Persist $persist;
    private SerializerInterface $serializer;
    private ActivityRepository $activityRepository;
    private ItemDataProviderInterface $itemDataProvider;
    private IriConverterInterface $iriConverter;
    private string $personType;

    public function __construct(Persist $persist, SerializerInterface $serializer, ActivityRepository $activityRepository, ItemDataProviderInterface $itemDataProvider, IriConverterInterface $iriConverter, string $personType = Person::class)
    {
        $this->persist = $persist;
        $this->serializer = $serializer;
        $this->activityRepository = $activityRepository;
        $this->itemDataProvider = $itemDataProvider;
        $this->iriConverter = $iriConverter;
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
            return $this->handlePost($request);
        }

        $activities = $this->activityRepository->getActivitiesFor($this->iriConverter->getIriFromItem($person));
        $json = $this->serializer->normalize($activities, CollectionNormalizer::FORMAT, ['skip_null_values' => true]);

        return new JsonResponse($json, 200, [
            'Content-Type' => 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"',
        ]);
    }

    private function handlePost(Request $request): JsonResponse
    {
        // TODO: validate the request using JSON Schema: https://github.com/redaktor/ActivityPubSchema
        // TODO: check that the activity belongs to this user
        //try {
        $activityJson = $this->serializer->decode($request->getContent(), 'json');
        ($this->persist)($activityJson);
        /*} catch (\Exception $e) {
            //throw new BadRequestHttpException('Invalid JSON', $e);
        }*/

        return new JsonResponse(null, 202, [
            'Content-Type' => 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"',
        ]);
    }
}
