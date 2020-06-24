<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Delete Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Delete
 *
 * @ORM\Entity
 * @ORM\Table(name="`delete`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Delete")
 */
class Delete extends Activity
{
}
