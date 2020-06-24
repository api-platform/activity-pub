<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Actor tentatively rejects the object.
 *
 * @see http://www.w3.org/ns/activitystreams#TentativeReject
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#TentativeReject")
 */
class TentativeReject extends Reject
{
}
