<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An Activity that has no direct object.
 *
 * @see http://www.w3.org/ns/activitystreams#IntransitiveActivity
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#IntransitiveActivity")
 */
abstract class IntransitiveActivity extends Activity
{
}
