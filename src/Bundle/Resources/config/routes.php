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

use ApiPlatform\ActivityPub\Action\Inbox;
use ApiPlatform\ActivityPub\Action\Outbox;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->add('activity_pub_outbox', '/people/{personId}/outbox')
        ->controller(Outbox::class)
        ->methods(['GET', 'HEAD', 'POST']);
    $routes->add('activity_pub_inbox', '/people/{personId}/inbox')
        ->controller(Inbox::class)
        ->methods(['GET', 'HEAD', 'POST']);
};
