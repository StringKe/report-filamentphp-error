<?php

namespace App\Filament\Company\Pages\Tenancy;

class JoinCompany extends CreateCompany
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.tenancy.join';

    public static function getLabel(): string
    {
        return 'Join Company';
    }


}
