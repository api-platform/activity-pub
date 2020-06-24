<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Join Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Join
 *
 * @ORM\Entity
 * @ORM\Table(name="`join`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Join")
 */
class Join extends Activity
{
}
