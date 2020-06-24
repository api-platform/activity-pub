<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Group of any kind.
 *
 * @see http://www.w3.org/ns/activitystreams#Group
 *
 * @ORM\Entity
 * @ORM\Table(name="`group`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Group")
 */
class Group extends Object_
{
}
