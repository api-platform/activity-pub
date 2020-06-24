<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Undo Something. This would typically be used to indicate that a previous Activity has been undone.
 *
 * @see http://www.w3.org/ns/activitystreams#Undo
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Undo")
 */
class Undo extends Activity
{
}
