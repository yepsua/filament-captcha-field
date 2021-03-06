<?php

namespace Yepsua\Filament\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Yepsua\Filament\FilamentCaptchaFieldServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentCaptchaFieldServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
