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

use App\Entity\Activity;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Finds activities related to users.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class ActivityRepository
{
    private ManagerRegistry $managerRegistry;
    private string $activityType;

    public function __construct(ManagerRegistry $managerRegistry, string $activityType = Activity::class)
    {
        $this->managerRegistry = $managerRegistry;
        $this->activityType = $activityType;
    }

    /**
     * @todo Use Doctrine Paginator
     */
    public function getActivitiesOf(string $actor): array
    {
        $query = $this->managerRegistry->getManagerForClass($this->activityType)->createQuery(
            <<<DQL
SELECT a FROM {$this->activityType} a WHERE a.actor = :actor
DQL
        );
        $query->setParameter('actor', $actor);

        return $query->getResult();
    }

    public function getActivitiesFor(string $actor): array
    {
        $query = $this->managerRegistry->getManagerForClass($this->activityType)->createQuery(
            <<<DQL
SELECT a FROM {$this->activityType} a WHERE
    JSONB_AG(a.to, :actor) = true
    OR JSONB_AG(a.to, '"https://www.w3.org/ns/activitystreams#Public"') = true
    OR JSONB_AG(a.to, '"as:Public"') = true
    OR JSONB_AG(a.bto, :actor) = true
    OR JSONB_AG(a.bto, '"https://www.w3.org/ns/activitystreams#Public"') = true
    OR JSONB_AG(a.bto, '"as:Public"') = true
    OR JSONB_AG(a.cc, :actor) = true
    OR JSONB_AG(a.cc, '"https://www.w3.org/ns/activitystreams#Public"') = true
    OR JSONB_AG(a.cc, '"as:Public"') = true
    OR JSONB_AG(a.bcc, :actor) = true
    OR JSONB_AG(a.bcc, '"https://www.w3.org/ns/activitystreams#Public"') = true
    OR JSONB_AG(a.bcc, '"as:Public"') = true
DQL
        );
        $query->setParameter('actor', json_encode($actor, JSON_THROW_ON_ERROR));

        return $query->getResult();
    }
}
