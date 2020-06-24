<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <kevin@dunglas.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\ActivityPub\Serializer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Normalizes ActivityPub collection as as:OrderedCollection instances.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class CollectionNormalizer implements ContextAwareNormalizerInterface, CacheableSupportsMethodInterface, SerializerAwareInterface
{
    public const FORMAT = 'activitypub:collection';

    private SerializerInterface $serializer;

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return self::FORMAT === $format && \is_array($data);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            '@context' => 'https://www.w3.org/ns/activitystreams',
            'type' => 'OrderedCollection',
            'totalItems' => \count($object),
            'orderedItems' => array_map(
                function (array $item) {
                    unset($item['@context']);

                    return $item;
                },
                $this->serializer->normalize($object, 'jsonld', $context + ['jsonld_has_context' => true])
            ),
        ];
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}
