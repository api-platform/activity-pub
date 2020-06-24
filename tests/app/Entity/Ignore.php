<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor is ignoring the Object.
 *
 * @see http://www.w3.org/ns/activitystreams#Ignore
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Ignore")
 */
abstract class Ignore extends Activity
{
}
