<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Short note, typically less than a single paragraph. A "tweet" is an example, or a "status update".
 *
 * @see http://www.w3.org/ns/activitystreams#Note
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Note")
 */
class Note extends Object_
{
}
