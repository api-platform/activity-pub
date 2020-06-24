<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor announces the object to the target.
 *
 * @see http://www.w3.org/ns/activitystreams#Announce
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Announce")
 */
class Announce extends Activity
{
}
