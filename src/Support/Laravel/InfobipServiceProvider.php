<?php

declare(strict_types=1);

namespace Infobip\Support\Laravel;

use Illuminate\Support\ServiceProvider;
use Infobip\InfobipClient;

class InfobipServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/infobip.php' => $this->app->configPath('infobip.php'),
        ], 'infobip');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/infobip.php',
            'infobip'
        );

        $this->app->singleton(InfobipClient::class, function ($app) {
            /** @var \Illuminate\Contracts\Config\Repository $config */
            $config = $this->app->get('config');

            return new InfobipClient(
                (string) $config->get('infobip.api_key'),
                (string) $config->get('infobip.base_url'),
                (float) $config->get('infobip.timeout')
            );
        });
    }
}
