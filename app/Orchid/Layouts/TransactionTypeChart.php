<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class TransactionTypeChart extends Chart
{
    protected $title = 'Transactions per type';
    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';


    protected $target = 'transactions_type';
    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = false;
}
