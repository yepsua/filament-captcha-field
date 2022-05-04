<?php

namespace Yepsua\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;

class Captcha extends TextInput
{
    protected string $config;

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->required()->rule(
            function () {
            return function (string $attribute, $value, \Closure $fail) {
                // Prevent double submit;
                if (session()->has('already_validated_' . $attribute)) {
                    return;
                }
                if (! captcha_check($value)) {
                    return $fail("The {$attribute} is invalid.");
                }
                session()->flash('already_validated_' . $attribute);
            };
        },
        );
        $this->config('math');
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
        $this->type = 'text';

        if ($this->config === 'math') {
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
