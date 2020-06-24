<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @see http://www.w3.org/ns/activitystreams#Block
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Block")
 */
class Block extends Ignore
{
}
