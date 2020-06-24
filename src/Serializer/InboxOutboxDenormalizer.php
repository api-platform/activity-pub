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

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Detects the type of the PHP class to use based on the JSON-LD type.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class InboxOutboxDenormalizer implements DenormalizerInterface, SerializerAwareInterface, CacheableSupportsMethodInterface
{
    public const TYPE = 'activitypub:iobox';

    private SerializerInterface $serializer;
    private string $entityNamespace;

    public function __construct(string $entityNamespace = 'App\\Entity\\')
    {
        $this->entityNamespace = $entityNamespace;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if (!($data['type'] ?? false) || !class_exists($className = $this->entityNamespace.$data['type'])) {
            throw new InvalidArgumentException('Invalid object type');
        }

        return $this->serializer->denormalize($data, $className, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return self::TYPE === $type;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        if (!$serializer instanceof DenormalizerInterface) {
            throw new RuntimeException('The provided serializer isn\'t a denormalizer');
        }

        $this->serializer = $serializer;
    }
}
