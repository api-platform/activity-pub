<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A physical or logical location.
 *
 * @see http://www.w3.org/ns/activitystreams#Place
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Place")
 */
class Place extends Object_
{
}
