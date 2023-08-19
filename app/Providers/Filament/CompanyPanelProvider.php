<?php

namespace App\Providers\Filament;

use App\Filament\Company\Pages\Auth\LoginUser;
use App\Filament\Company\Pages\Auth\RegistryUser;
use App\Filament\Company\Pages\Tenancy\CreateCompany;
use App\Filament\Company\Pages\Tenancy\JoinCompany;
use App\Http\Controllers\Company\OAuthController;
use App\Models\Company;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CompanyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel->default()
            ->id('company')
            ->path('company')
            ->tenant(Company::class)
            ->tenantRegistration(CreateCompany::class)
            ->login(LoginUser::class)
            ->registration(RegistryUser::class)
            ->routes(function () {
                Route::middleware(config('filament.middleware.base'))
                    ->group(function () {
                        Route::get('join', JoinCompany::class)
                            ->name('join');

                        Route::name('social.')
                            ->group(function () {
                                Route::get('/oauth/{provider}', [
                                    OAuthController::class,
                                    'redirect',
                                ])
                                    ->name('oauth.redirect');

                                Route::get('/oauth/callback/{provider}', [
                                    OAuthController::class,
                                    'callback',
                                ])
                                    ->name('oauth.callback');
                            });
                    });
            })
            ->colors([
                'primary' => Color::Green,
                'secondary' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
