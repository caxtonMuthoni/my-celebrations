<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Template extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function image() {
        return $this->hasOne(Attachment::class, 'id', 'cover_image');
    }

    public function template_file() {
        return $this->hasOne(Attachment::class, 'id', 'template');
    }
}
