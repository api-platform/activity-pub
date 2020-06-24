<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor viewed the object.
 *
 * @see http://www.w3.org/ns/activitystreams#View
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#View")
 */
class View extends Activity
{
}
