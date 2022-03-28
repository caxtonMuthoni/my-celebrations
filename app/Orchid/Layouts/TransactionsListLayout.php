<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\Transaction;
use Carbon\Carbon;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TransactionsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'transactions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('transaction_id', 'Transaction ID'),
            TD::make('amount', 'Transaction Amount')->render(function (Transaction $transaction) {
                return number_format($transaction->amount, 2);
            }),
            TD::make('type', 'Transaction Type'),
            TD::make('user_id', 'Transacted By')->render(function ($transaction) {
                return $transaction->user->name;
            }),

            TD::make('created_at', 'Transacted At')->render(function (Transaction $transaction) {
                $createdAt = Carbon::parse($transaction->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
        ];
    }
}
