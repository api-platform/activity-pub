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

use App\Entity\Activity;
use App\Entity\Object_;
use App\Entity\Person;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Normalizes an ActivityPub object.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
final class ItemNormalizer implements ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface, CacheableSupportsMethodInterface, SerializerAwareInterface
{
    private NormalizerInterface $normalizer;
    private RouterInterface $router;
    private string $objectType;
    private string $activityType;
    private string $personType;

    public function __construct(NormalizerInterface $normalizer, RouterInterface $router, string $objectType = Object_::class, string $activityType = Activity::class, string $personType = Person::class)
    {
        if (!$normalizer instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The normalizer must also implement "%s".', DenormalizerInterface::class));
        }

        $this->normalizer = $normalizer;
        $this->router = $router;
        $this->objectType = $objectType;
        $this->activityType = $activityType;
        $this->personType = $personType;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $rest = $this->normalizer->normalize($object, $format, $context + ['jsonld_has_context' => true]);
        // TODO: Introduce an interface instead of using this hack. This requires to modify api-platform/schema-generator to add support for external interfaces
        if (!\is_array($rest) || (!is_a($object, $this->objectType) && !is_a($object, $this->activityType))) {
            return $rest;
        }

        $first = [
            '@context' => 'https://www.w3.org/ns/activitystreams',
            'type' => str_replace('http://www.w3.org/ns/activitystreams#', '', $rest['@type']),
            'id' => $rest['externalId'] ?? $rest['@id'],
        ];

        unset($rest['@id'], $rest['@type'], $rest['id'], $rest['externalId']);

        if (is_a($object, $this->personType)) {
            $personId = $object->getId();
            $first['inbox'] = $this->router->generate('activity_pub_inbox', ['personId' => $personId], RouterInterface::ABSOLUTE_URL);
            $first['outbox'] = $this->router->generate('activity_pub_outbox', ['personId' => $personId], RouterInterface::ABSOLUTE_URL);
        }

        return array_merge($first, $rest);
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format, $context);
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $this->normalizer->supportsNormalization($data, $format, $context);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $externalId = $data['id'] ?? null;
        unset($data['id']);
        $object = $this->normalizer->denormalize($data, $type, $format, $context);
        if ($externalId) {
            $object->setExternalId($externalId);
        }

        return $object;
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        if ($this->normalizer instanceof SerializerAwareInterface) {
            $this->normalizer->setSerializer($serializer);
        }
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return $this->normalizer instanceof CacheableSupportsMethodInterface && $this->normalizer->hasCacheableSupportsMethod();
    }
}
