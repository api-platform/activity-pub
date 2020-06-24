<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Offer something to someone or something.
 *
 * @see http://www.w3.org/ns/activitystreams#Offer
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Offer")
 */
abstract class Offer extends Activity
{
}
