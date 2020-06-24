<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Create Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Create
 *
 * @ORM\Entity
 * @ORM\Table(name="`create`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Create")
 */
class Create extends Activity
{
}
