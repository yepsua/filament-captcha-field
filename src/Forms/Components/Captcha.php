<?php

namespace Yepsua\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;

class Captcha extends TextInput
{
    protected string $config;

    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        $this->required()->rules('required|captcha');
        $this->config('math');
    }

    /**
     * {@inheritDoc}
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
        $this->type = 'text';

        if($this->config === 'math') {
            $this->type = 'number';
        }

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
