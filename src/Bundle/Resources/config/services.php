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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use ApiPlatform\ActivityPub\Action\Inbox;
use ApiPlatform\ActivityPub\Action\Outbox;
use ApiPlatform\ActivityPub\ActivityRepository;
use ApiPlatform\ActivityPub\Persist;
use ApiPlatform\ActivityPub\Publish;
use ApiPlatform\ActivityPub\Serializer\CollectionNormalizer;
use ApiPlatform\ActivityPub\Serializer\InboxOutboxDenormalizer;
use ApiPlatform\ActivityPub\Serializer\ItemNormalizer;

return static function (ContainerConfigurator $container): void {
    $container
        ->services()
        ->defaults()
            ->autowire()
        ->set(Publish::class)
        ->set(Persist::class)
        ->set(ActivityRepository::class)

        // Serializer
        ->set(ItemNormalizer::class)
            ->decorate('api_platform.jsonld.normalizer.item')
        ->set(CollectionNormalizer::class)
            ->autoconfigure()
        ->set(InboxOutboxDenormalizer::class)
            ->autoconfigure()

        // Actions
        ->set(Outbox::class)
            ->public()
        ->set(Inbox::class)
            ->public();
};
