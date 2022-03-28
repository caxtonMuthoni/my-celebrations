<?php

namespace App\Orchid\Screens;

use App\Models\Transaction;
use App\Orchid\Layouts\TransactionsListLayout;
use Orchid\Screen\Screen;

class TransactionsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'transactions' => Transaction::latest()->paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Business transactions';
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
            TransactionsListLayout::class
        ];
    }
}
