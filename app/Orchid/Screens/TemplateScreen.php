<?php

namespace App\Orchid\Screens;

use App\Models\Template;
use App\Orchid\Layouts\TemplateListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TemplateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'templates' => Template::with('image')->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Book templates';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('New template')
            ->icon('note')
            ->route('platform.dashboard.template.edit')
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
            TemplateListLayout::class
        ];
    }
}
