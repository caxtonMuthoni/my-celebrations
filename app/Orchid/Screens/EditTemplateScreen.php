<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use ZipArchive;

class EditTemplateScreen extends Screen
{

    protected $exists = false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Template $template): iterable
    {
        $this->exists = $template->exists;
        return [
            "template" => $template
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
            return 'Edit book template';
        }

        return "Adding new book template";
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
            Layout::columns([
                Layout::rows([
                    Input::make('template.name')->type('text')->title('Template name')->help('What is the template\'s title? '),
                    TextArea::make('template.description')->type('text')
                        ->title('Template description')->help('Tell us more about the template? ')
                        ->rows(8),
                    Relation::make('template.category_id')
                        ->fromModel(Category::class, 'name')
                        ->title('Template book category')
                        ->help('Select the categories the template belongs to.')
                        ->multiple()
                ]),

                Layout::rows([
                    Upload::make('template.cover_image')->maxFiles(1)->title("Upload template cover image")->help('Help the users understand more about templates using an image.'),
                    Upload::make('template.template')->maxFiles(1)->title("Upload the template")->help('Upload the template file here.'),
                ])
            ])
        ];
    }

    public function createOrUpdate(Template $template, Request $request)
    {
        ini_set('max_execution_time', '0');
        $templateData = $request->get('template');
        foreach ($templateData['category_id'] as $catID) {
            $category = Category::find($catID);
            if (isset($category)) {
                $template->template = $templateData['template'][0];
                $template->cover_image = $templateData['cover_image'][0];
                $template->name = $templateData['name'];
                $template->description = $templateData['description'];
                $template->category_id = $category->id;
                if ($template->save()) {
                    $template = $template->refresh();
                    $zipPhysicalPath = 'app/public/' . $template->template_file->physicalPath();                    
                    $zipPath = storage_path($zipPhysicalPath);
                    $zip = new ZipArchive;
                    $time = time();
                    $path = 'templates/book/'. $time;
                    if ($zip->open($zipPath)) {
                        $uploaded = $zip->extractTo('templates/book/'. $time);
                        if($uploaded) {
                            $url = env('APP_URL') .'/' . $path . "/dist/index.html";
                            $template->template_url = $url;
                            $template->save();
                        }
                        $zip->close();
                    }
                }
            }
        }

        Alert::success('The template was uploaded successfully');
        return redirect()->route('platform.dashboard.template');
    }


    public function remove(Template $template)
    {
        if ($template->delete()) {
            Alert::success('The template was deleted successfully');
            return redirect()->route('platform.dashboard.template');
        }
    }
}
