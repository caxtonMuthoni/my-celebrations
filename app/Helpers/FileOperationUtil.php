<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileOperationUtil
{
    private $folder, $file;

    public function __construct($file, $folder='images')
    {
        $this->file = $file;
        $this->folder = $folder;
    }

    public function uploadFile()
    {
        $filenameWithExt = $this->file->getClientOriginalName();
        // Get Filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just Extension
        $extension = $this->file->getClientOriginalExtension();
        // Filename To store
        $fileNameToStore = preg_replace('/\s+/', '', $filename) . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $this->file->storeAs($this->folder, $fileNameToStore, 'public');
        // $img = \Image::make($this->file)->encode('jpg', 10);
        // Storage::disk('public')->put("/$this->folder/$fileNameToStore", (string)$img);
        return $fileNameToStore;
    }

    public function deleteFile() {
        if(Storage::disk('public')->exists("/{$this->folder}/{$this->file}")) {
          Storage::disk('public')->delete("/{$this->folder}/{$this->file}");
        }
    }
}
