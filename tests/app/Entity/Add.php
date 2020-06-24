<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Add an Object or Link to Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Add
 *
 * @ORM\Entity
 * @ORM\Table(name="`add`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Add")
 */
class Add extends Activity
{
}
