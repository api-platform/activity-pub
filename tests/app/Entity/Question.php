<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A question of any sort.
 *
 * @see http://www.w3.org/ns/activitystreams#Question
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Question")
 */
class Question extends IntransitiveActivity
{
}
