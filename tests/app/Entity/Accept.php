<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor accepts the Object.
 *
 * @see http://www.w3.org/ns/activitystreams#Accept
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Accept")
 */
abstract class Accept extends Activity
{
}
