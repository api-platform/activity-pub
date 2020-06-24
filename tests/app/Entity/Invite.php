<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To invite someone or something to something.
 *
 * @see http://www.w3.org/ns/activitystreams#Invite
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Invite")
 */
class Invite extends Offer
{
}
