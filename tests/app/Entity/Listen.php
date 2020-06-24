<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor listened to the object.
 *
 * @see http://www.w3.org/ns/activitystreams#Listen
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Listen")
 */
class Listen extends Activity
{
}
