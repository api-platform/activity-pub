<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A written work. Typically several paragraphs long. For example, a blog post or a news article.
 *
 * @see http://www.w3.org/ns/activitystreams#Article
 *
 * @ORM\Entity
 * @ApiResource(iri="http://www.w3.org/ns/activitystreams#Article")
 */
class Article extends Object_
{
}
