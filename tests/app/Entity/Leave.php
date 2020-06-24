<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Leave Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Leave
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Leave")
 */
class Leave extends Activity
{
}
