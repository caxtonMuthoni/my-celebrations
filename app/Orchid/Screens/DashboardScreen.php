<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use App\Orchid\Layouts\DashBoardMetrics;
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
        return [
            'stats' => [
                ['value' => number_format(Transaction::sum('amount'), 2), 'title' => 'Total sales', 'icon' => 'money'],
                ['value' => number_format(User::count(), 0), 'title' => 'Total users', 'icon' => 'people'],
                ['value' => number_format(11, 0), 'title' => 'Subscribed users', 'icon' => 'check'],
                ['value' => number_format(Book::count(), 0), 'title' => 'Total books', 'icon' => 'book-open'],
            ],
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
                Layout::rows([
                    Input::make('test'),
                ])
            ])

        ];
    }
}
