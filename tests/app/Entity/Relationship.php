<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a Social Graph relationship between two Individuals (indicated by the 'a' and 'b' properties).
 *
 * @see http://www.w3.org/ns/activitystreams#Relationship
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Relationship")
 */
class Relationship extends Object_
{
}
