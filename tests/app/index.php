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

use ApiPlatform\ActivityPub\Bundle\ApiPlatformActivityPubBundle;
use ApiPlatform\ActivityPub\Doctrine\JsonbAtGreater;
use ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\RouterInterface;

require __DIR__.'/../../vendor/autoload.php';

/**
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
class MyActivityPubApp extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new SecurityBundle();
        yield new DoctrineBundle();
        yield new TwigBundle();
        yield new ApiPlatformBundle();
        yield new ApiPlatformActivityPubBundle();
        yield new WebProfilerBundle();
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('framework', [
            'assets' => [
                'base_path' => '/public',
            ],
            'profiler' => [
                'only_exceptions' => false,
            ],
        ]);

        $container
            ->extension('doctrine', [
                'dbal' => [
                    'url' => $_SERVER['DATABASE_URL'] ?? 'postgresql://dunglas@127.0.0.1:5432/ap?serverVersion=11&charset=utf8',
                ],
                'orm' => [
                    'dql' => [
                        'string_functions' => [
                            'JSONB_AG' => JsonbAtGreater::class,
                        ],
                    ],
                    'auto_generate_proxy_classes' => true,
                    'auto_mapping' => true,
                    'mappings' => [
                        'App' => [
                            'is_bundle' => false,
                            'type' => 'annotation',
                            'dir' => '%kernel.project_dir%/Entity',
                            'prefix' => 'App\Entity',
                            'alias' => 'App',
                        ],
                    ],
                ],
            ]);

        $container->extension('api_platform', [
            'mapping' => [
                'paths' => ['%kernel.project_dir%/Entity'],
            ],
            'formats' => [
                'jsonld' => ['application/ld+json', 'application/ld+json; profile="https://www.w3.org/ns/activitystreams"', 'application/activity+json'],
                'html' => ['text/html'],
            ],
            'patch_formats' => [
                'json' => ['application/merge-patch+json'],
            ],
            'swagger' => [
                'versions' => [3],
            ],
            'defaults' => [
                'url_generation_strategy' => RouterInterface::ABSOLUTE_URL,
                'normalization_context' => ['skip_null_values' => true],
                /*'item_operations' => ['GET'],
                'collection_operations' => ['GET'],*/
            ],
        ]);

        $container->extension('web_profiler', [
            'toolbar' => true,
            'intercept_redirects' => false,
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('.', 'api_platform');
        $routes->import('@ApiPlatformActivityPubBundle/Resources/config/routes.php');
        $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
        $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }
}

$app = new MyActivityPubApp('dev', true);

if (PHP_SAPI === 'cli') {
    $application = new Application($app);
    exit($application->run());
}

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);
