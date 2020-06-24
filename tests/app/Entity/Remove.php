<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Remove Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Remove
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Remove")
 */
class Remove extends Activity
{
}
