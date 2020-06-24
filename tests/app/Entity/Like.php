<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Like Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Like
 *
 * @ORM\Entity
 * @ORM\Table(name="`like`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Like")
 */
class Like extends Activity
{
}
