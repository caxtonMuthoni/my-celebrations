<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditCategoryScreen extends Screen
{

    private $exists = false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $this->exists = $category->exists;
        return [
            'category' => $category,
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
            return 'Edit book category';
        }

        return 'Add new book category';
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
                Input::make('category.name')->type('text')->title('Category name')->help('What is the categories name ? eg. weddings'),
                Picture::make('category.image')->title('Category image')->help('Add category unique image to draw your customers attention.')
            ])
        ];
    }

    public function createOrUpdate(Category $category, Request $request)
    {
        // validation
        $this->validate($request, [
            'category.name' => [
                'required', 'string',
                 Rule::unique('categories', 'name')->ignore($category->id)
            ],
            'category.image' => [
                'required', 'string',
                 Rule::unique('categories', 'image')->ignore($category->id)
            ]
        ], [
            'category.name.required' => 'Category name is required',
            'category.name.unique' => 'A category with this name exists.',
            'category.image.required' => 'Category image is required',
            'category.image.unique' => 'This image is being used in another category',
        ]);

        $categoryData = $request->get('category');
        $category->fill($categoryData)->save();

        if ($this->exists) {
            Alert::info('You have successfully updated the book category.');
        } else {
            Alert::info('You have successfully created new book category.');
        }

        return redirect()->route('platform.dashboard.category');
    }

    public function remove(Category $category)
    {
        if ($category->delete()) {
            Alert::info('You have successfully deleted the book category.');

            return redirect()->route('platform.dashboard.category');
        }
    }
}
