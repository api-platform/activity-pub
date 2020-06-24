<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Express Interest in Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Follow
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Follow")
 */
class Follow extends Activity
{
}
