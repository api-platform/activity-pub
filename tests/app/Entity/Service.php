<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A service provided by some entity.
 *
 * @see http://www.w3.org/ns/activitystreams#Service
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Service")
 */
class Service extends Object_
{
}
