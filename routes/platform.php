<?php

declare(strict_types=1);

use App\Orchid\Screens\BooksScreen;
use App\Orchid\Screens\CategoryScreen;
use App\Orchid\Screens\DashboardScreen;
use App\Orchid\Screens\EditCategoryScreen;
use App\Orchid\Screens\EditFaqScreen;
use App\Orchid\Screens\EditSubscriberScreen;
use App\Orchid\Screens\EditSubscriptionFeaturesScreen;
use App\Orchid\Screens\EditSubscriptionPlansScreen;
use App\Orchid\Screens\EditTemplateScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\FaqsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\SubscriptionFeaturesScreen;
use App\Orchid\Screens\SubscriptionPlansScreen;
use App\Orchid\Screens\SubscriptionsScreen;
use App\Orchid\Screens\TemplateScreen;
use App\Orchid\Screens\TransactionsScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', DashboardScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...


Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', Idea::class, 'platform.screens.idea');


// Routes
Route::screen('dashboard', DashboardScreen::class)
    ->name('platform.dashboard')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Dashboard');
    });

 Route::screen('categories', CategoryScreen::class)->name('platform.dashboard.category');
 Route::screen('category/{category?}', EditCategoryScreen::class)->name('platform.dashboard.category.edit');

 Route::screen('templates', TemplateScreen::class)->name('platform.dashboard.template');
 Route::screen('template/{template?}', EditTemplateScreen::class)->name('platform.dashboard.template.edit');

 Route::screen('books', BooksScreen::class)->name('platform.dashboard.book');

 Route::screen('subscriptions', SubscriptionsScreen::class)->name('platform.dashboard.subscription');
 Route::screen('subscription/{subscriber?}', EditSubscriberScreen::class)->name('platform.dashboard.subscription-edit');

 Route::screen('transactions', TransactionsScreen::class)->name('platform.dashboard.transaction');

 Route::screen('subscriptions/plans', SubscriptionPlansScreen::class)->name('platform.dashboard.subscription-plans');
 Route::screen('subscriptions/plan/{plan?}', EditSubscriptionPlansScreen::class)->name('platform.dashboard.subscription-plans-edit');

 Route::screen('subscriptions/features', SubscriptionFeaturesScreen::class)->name('platform.dashboard.subscription-features');
 Route::screen('subscriptions/feature/{plan?}', EditSubscriptionFeaturesScreen::class)->name('platform.dashboard.subscription-features-edit');

 Route::screen('faqs', FaqsScreen::class)->name('platform.dashboard.faqs');
 Route::screen('faq/{faq?}', EditFaqScreen::class)->name('platform.dashboard.faq-edit');
