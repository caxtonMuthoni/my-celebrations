<?php

namespace App\Orchid\Screens;

use App\Models\Faq;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditFaqScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Faq $faq): iterable
    {
        $this->exists = $faq->exists;

        return [
            'faq' => $faq
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        if ($this->exists) {
            return 'Edit faq';
        }
        return 'Create new faq';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('createOrUpdate')
                ->class('btn btn-success')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->class('btn btn-danger')
                ->canSee($this->exists),
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
            Layout::rows([
                TextArea::make('faq.question')->title('FAQ Question')->help('Enter your question here'),
                TextArea::make('faq.answer')->title('FAQ Answer')->help('Enter your answer to the question abovr here'),
            ])
        ];
    }

    public function createOrUpdate(Faq $faq, Request $request)
    {
        $faqData = $request->get('faq');
        $faq->question = $faqData['question'];
        $faq->answer = $faqData['answer'];
        $faq->save();

        Alert::success('The faq data added successfully');
        return redirect()->route('platform.dashboard.faqs');
    }


    public function remove(Faq $faq)
    {
        if ($faq->delete()) {
            Alert::success('The faq was deleted successfully');
            return redirect()->route('platform.dashboard.faqs');
        }
    }
}
