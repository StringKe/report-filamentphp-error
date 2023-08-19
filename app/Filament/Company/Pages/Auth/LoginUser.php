<?php

namespace App\Filament\Company\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login;
use Illuminate\Support\HtmlString;

class LoginUser extends Login
{
    protected static string $view = 'filament.pages.auth.login';

    public function form(Form $form): Form
    {
        return $form->schema([
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
            $this->getPrivacyPolicyLink(),
        ])
            ->statePath('data');
    }


    protected function getPrivacyPolicyLink(): Component
    {
        return Checkbox::make('accept')
            ->label(fn() => new HtmlString(
                __('auth.privacy_policy', [
                    'privacy_policy_url' => route('welcome'),
                    'terms_and_conditions_url' => route('welcome'),
                ])
            ))
            ->validationAttribute("Terms and conditions")
            ->default(true)
            ->required();
    }
}
