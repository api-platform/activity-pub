<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Profile Document.
 *
 * @see http://www.w3.org/ns/activitystreams#Profile
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Profile")
 */
class Profile extends Object_
{
}
