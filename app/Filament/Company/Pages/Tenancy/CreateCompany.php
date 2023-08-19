<?php

namespace App\Filament\Company\Pages\Tenancy;


use App\Models\Company;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Str;

class CreateCompany extends RegisterTenant
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.tenancy.create';

    public static function getLabel(): string
    {
        return 'Create Company';
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Name')
                ->live(onBlur: true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                    if (($get('slug') ?? '') !== Str::slug($old)) {
                        return;
                    }

                    $set('slug', Str::slug($state));
                })
                ->required(),
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique('companies', 'slug')
                ->minValue(1)
                ->maxValue(48)
                ->rule('alpha_dash'),
        ]);
    }

    public function getWidgetData()
    {
        return [];
    }

    protected function handleRegistration(array $data): Company
    {
        $team = Company::create($data);

        $team->members()
            ->attach(auth()->user());

        return $team;
    }
}
