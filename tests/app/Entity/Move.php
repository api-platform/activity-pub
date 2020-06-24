<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor is moving the object. The target specifies where the object is moving to. The origin specifies where the object is moving from.
 *
 * @see http://www.w3.org/ns/activitystreams#Move
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Move")
 */
class Move extends Activity
{
}
