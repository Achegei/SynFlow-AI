<?php
namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Pages;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use App\Filament\Widgets\AccountWidget; // Import the AccountWidget
use Filament\View\PanelsRenderHook;
use Filament\Support\Facades\FilamentView;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->brandName('SynFlow AI')
            ->brandLogo(asset('images/synflowlogo.png'))

            // 👇 Use hooks instead of Topbar class
            ->renderHook(PanelsRenderHook::TOPBAR_START, fn () => view('components.topbar-user'))

            ->login()
            ->colors([
                Color::Indigo,
                Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Removed AccountWidget since we're moving it to the topbar
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
