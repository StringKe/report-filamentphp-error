<?php

namespace App\Filament\Company\Pages\Auth;


use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;
use Illuminate\Support\HtmlString;

class RegistryUser extends Register
{

    protected static string $view = 'filament.pages.auth.register';


    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)
                ->schema([
                    TextInput::make('first_name')
                        ->label('First Name')
                        ->maxLength(255)
                        ->autofocus()
                        ->required(),
                    TextInput::make('last_name')
                        ->label('Last Name')
                        ->maxLength(255)
                        ->required(),
                ]),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            $this->getPrivacyPolicyLink()
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
