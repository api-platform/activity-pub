<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor dislikes the object.
 *
 * @see http://www.w3.org/ns/activitystreams#Dislike
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Dislike")
 */
class Dislike extends Activity
{
}
