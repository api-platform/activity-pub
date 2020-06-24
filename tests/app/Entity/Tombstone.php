<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A placeholder for a deleted object.
 *
 * @see http://www.w3.org/ns/activitystreams#Tombstone
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Tombstone")
 */
class Tombstone extends Object_
{
}
