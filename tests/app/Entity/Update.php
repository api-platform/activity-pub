<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * To Update/Modify Something.
 *
 * @see http://www.w3.org/ns/activitystreams#Update
 *
 * @ORM\Entity
 * @ORM\Table(name="`update`")
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Update")
 */
class Update extends Activity
{
}
