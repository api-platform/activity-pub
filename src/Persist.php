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

use ApiPlatform\ActivityPub\Serializer\InboxOutboxDenormalizer;
use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Activity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Persists activities received in the inbox.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class Persist
{
    private SerializerInterface $serializer;
    private IriConverterInterface $iriConverter;
    private DataPersisterInterface $dataPersister;
    private ManagerRegistry $managerRegistry;
    private string $activityType;

    public function __construct(SerializerInterface $serializer, IriConverterInterface $iriConverter, DataPersisterInterface $dataPersister, ManagerRegistry $managerRegistry, string $activityType = Activity::class)
    {
        $this->serializer = $serializer;
        $this->iriConverter = $iriConverter;
        $this->dataPersister = $dataPersister;
        $this->managerRegistry = $managerRegistry;
        $this->activityType = $activityType;
    }

    public function __invoke(array $activityJson): void
    {
        if (!isset($activityJson['id'])) {
            throw new \InvalidArgumentException('The activity must have an ID');
        }
        if ($activityJson['object']['id'] ?? false) {
            $activityJson['object'] = $activityJson['object']['id'];
        }

        if (!\is_string($activityJson['object'] ?? null)) {
            throw new \InvalidArgumentException('The object must have an ID');
        }

        try {
            // Check if objects exist
            $this->iriConverter->getItemFromIri($activityJson['id']);

            return;
        } catch (\Exception $e) {
            if ($this->managerRegistry->getManagerForClass($this->activityType)->getRepository($this->activityType)->findOneBy(['externalId' => $activityJson['id']])) {
                return;
            }
        }

        // TODO: refuse spoofed local URLs? It necessary with web signatures?
        $activity = $this->serializer->denormalize($activityJson, InboxOutboxDenormalizer::TYPE, 'jsonld');
        $this->dataPersister->persist($activity);
    }
}
