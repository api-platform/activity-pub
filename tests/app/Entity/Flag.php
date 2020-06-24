<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To flag something (e.g. flag as inappropriate, flag as spam, etc).
 *
 * @see http://www.w3.org/ns/activitystreams#Flag
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Flag")
 */
class Flag extends Activity
{
}
