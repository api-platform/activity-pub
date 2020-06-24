<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor is traveling to the target. The origin specifies where the actor is traveling from.
 *
 * @see http://www.w3.org/ns/activitystreams#Travel
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Travel")
 */
class Travel extends IntransitiveActivity
{
}
