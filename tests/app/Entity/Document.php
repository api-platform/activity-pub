<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a digital document/file of any sort.
 *
 * @see http://www.w3.org/ns/activitystreams#Document
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Document")
 */
abstract class Document extends Object_
{
}
