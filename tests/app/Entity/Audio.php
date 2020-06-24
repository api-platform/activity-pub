<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An audio file.
 *
 * @see http://www.w3.org/ns/activitystreams#Audio
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Audio")
 */
class Audio extends Document
{
}
