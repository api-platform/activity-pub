<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a software application of any sort.
 *
 * @see http://www.w3.org/ns/activitystreams#Application
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Application")
 */
class Application extends Object_
{
}
