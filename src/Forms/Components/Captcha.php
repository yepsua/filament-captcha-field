<?php

namespace Yepsua\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;

class Captcha extends TextInput
{
    protected string $config = 'default';

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->rules('required|captcha');
    }

    /**
     * {@inheritDoc}
     *
     * @return string|null
     */
    public function getHelperText(): ?string
    {
        return $this->evaluate($this->helperText . $this->getImage());
    }

    /**
     * Sets the config used by the function: captcha_img
     *
     * @param string $config
     * @return self
     */
    public function config(string $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the captcha image
     *
     * @return string
     */
    protected function getImage(): string
    {
        return captcha_img($this->config);
    }
}
