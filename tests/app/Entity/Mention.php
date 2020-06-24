<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A specialized Link that represents an \@mention.
 *
 * @see http://www.w3.org/ns/activitystreams#Mention
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Mention")
 */
class Mention extends Link
{
}
