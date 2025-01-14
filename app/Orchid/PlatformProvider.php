<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Dashboard')
                ->icon('monitor')
                ->route('platform.dashboard')
                ->title('Navigation')
                ->badge(function () {
                    return 6;
                }),

            Menu::make('Categories')
                ->icon('task')
                ->route('platform.dashboard.category'),

            Menu::make('Templates')
                ->icon('organization')
                ->route('platform.dashboard.template'),

            Menu::make('Books')
                ->icon('book-open')
                ->route('platform.dashboard.book'),

            Menu::make('Subscription')
                ->slug('subscription')
                ->icon('modules')
                ->list([
                    Menu::make('Subscribers')->icon('bag')->route('platform.dashboard.subscription'),
                    Menu::make('Subscription plans')->icon('heart')->route('platform.dashboard.subscription-plans'),
                    Menu::make('Subscription Features')->icon('settings')->route('platform.dashboard.subscription-features'),
                ]),

            Menu::make('Faqs')
                ->icon('book-open')
                ->route('platform.dashboard.faqs'),


            Menu::make('Transactions')
                ->icon('money')
                ->route('platform.dashboard.transaction'),


            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
