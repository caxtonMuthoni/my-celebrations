<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Models\User;
use App\Orchid\Layouts\BooksPlanChart;
use App\Orchid\Layouts\DashBoardMetrics;
use App\Orchid\Layouts\TransactionTypeChart;
use App\Orchid\Layouts\UserChart;
use App\Orchid\Layouts\UserSubscriptionChart;
use Carbon\Carbon;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Metric;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DashboardScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $plans = SubscriptionPlan::withCount('books')->get();
        $labels = [];
        $values = [];
        foreach ($plans as $plan) {
            array_push($labels, $plan->name);
            array_push($values, $plan->books_count);
        }

        $start = Carbon::now()->subDay(120);
        $end = Carbon::now()->subDay(1);
        return [
            'stats' => [
                ['value' => number_format(Transaction::sum('amount'), 2), 'title' => 'Total sales', 'icon' => 'money'],
                ['value' => number_format(User::count(), 0), 'title' => 'Total users', 'icon' => 'people'],
                ['value' => Subscriber::count(), 'title' => 'Subscriptions', 'icon' => 'check'],
                ['value' => number_format(Book::count(), 0), 'title' => 'Total books', 'icon' => 'book-open'],
            ],

            'books_plan' => [
                [
                    'labels' => $labels,
                    'values' => $values,
                ],
            ],

            'users_subscription' => [
                [
                    'labels' => ['Subscribed', 'Unsubscribed'],
                    'values' => [User::has('books', '>', 1)->count(), User::has('books', '<', 2)->count()],
                ],
            ],

            'transactions_type' => [
                [
                    'labels' => ['MPESA', 'PAYPAL'],
                    'values' => [Transaction::where('type', 'MPESA')->count(), Transaction::where('type', 'PAYPAL')->count()],
                ],
            ],

            'members' => [
                User::countByDays($start, $end)->toChart('Users'),
                Role::countByDays($start, $end)->toChart('Roles'),
            ]
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'System statistics';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('orchid.dashcard'),
            Layout::columns([
                BooksPlanChart::class,
                UserSubscriptionChart::class,
                TransactionTypeChart::class,
            ]),
            UserChart::class,
        ];
    }
}
