<?php

namespace Yepsua\Filament\FilamentCaptchaField;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Yepsua\Filament\FilamentCaptchaField\Commands\FilamentCaptchaFieldCommand;

class FilamentCaptchaFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-captcha-field')
            ->hasConfigFile()
            ->hasViews();
    }
}
