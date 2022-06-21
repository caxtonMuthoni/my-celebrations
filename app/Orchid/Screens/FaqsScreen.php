<?php

namespace App\Orchid\Screens;

use App\Models\Faq;
use App\Orchid\Layouts\FaqsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FaqsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'faqs' => Faq::latest()->paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'List of Faqs';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('New Faq')
            ->icon('note')
            ->route('platform.dashboard.faq-edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            FaqsListLayout::class
        ];
    }
}
