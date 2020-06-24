<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor tentatively accepts the Object.
 *
 * @see http://www.w3.org/ns/activitystreams#TentativeAccept
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#TentativeAccept")
 */
class TentativeAccept extends Accept
{
}
