<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\AsSource;

class Book extends Model
{
    use HasFactory, AsSource;

    protected $appends = ['image'];

    private $appUrl;

    public function __construct()
    {
        $this->appUrl = env('APP_URL');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function template() {
        return $this->belongsTo(Template::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute() {
        return $this->appUrl . Storage::url('cover_images/'.$this->attributes['cover_image']);
    }


}
