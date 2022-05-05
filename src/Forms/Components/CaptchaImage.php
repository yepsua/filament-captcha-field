<?php

namespace Yepsua\Filament\Forms\Components;

class CaptchaImage extends Captcha
{
    protected string $config;

    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rules = [];
        $this->required(false)->type('hidden')->disableLabel(true);
    }

    /**
     * {@inheritDoc}
     */
    public function config(string $config): self
    {
        parent::config($config);
        $this->type = 'hidden';

        return $this;
    }
}
