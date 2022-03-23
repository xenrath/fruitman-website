<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function deleteImage($id)
    {
        $image = Image::find($id);
        Storage::disk('local')->delete('public/uploads/' . $image->image);
        $image->delete();
    }
}
