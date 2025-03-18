<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Exception;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

final class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        // @codeCoverageIgnoreStart
        $userMenuItems = [];
        if (! app()->runningUnitTests()) {
            $userMenuItems = [
                'app' => MenuItem::make()
                    ->label(fn(): string => __('common.go_to_app'))
                    ->icon('heroicon-o-arrow-left-circle')
                    ->url(
                        function (): string {
                            return Filament::getPanel('app')->route('pages.dashboard', [
                                'tenant' => Auth::user()?->getActiveTenant(),
                            ]);
                        }
                    ),
                'profile' => MenuItem::make()
                    ->url(
                        function (): string {
                            return Filament::getPanel('app')->route('pages.edit-profile', [
                                'tenant' => Auth::user()?->getActiveTenant(),
                            ]);
                        }
                    ),
            ];
        }
        // @codeCoverageIgnoreEnd

        return $panel
            ->id('admin')
            ->path('admin')
            ->databaseTransactions()
            ->databaseNotifications()
            ->unsavedChangesAlerts()
            ->spa()
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->userMenuItems($userMenuItems)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(fn (): string => __('admin/employee-company-resource.navigation_group')),
                NavigationGroup::make()
                    ->label(fn (): string => __('admin/country-resource.navigation_group')),
                NavigationGroup::make()
                    ->label(fn (): string => __('admin/user-resource.navigation_group'))
                    ->collapsed(),
            ])
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ->plugins([
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
//            ->renderHook(
//                PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
//                fn (): string => Blade::render('<x-filament::badge color="primary">ADMIN</x-filament::badge>'),
//            );
    }
}
