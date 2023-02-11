<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Gallery;

class GalleryService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path('uploads/gallery/' . $model->file))) {
                File::delete(public_path('uploads/gallery/' . $model->file));
            }
            if (File::isFile(public_path('uploads/gallery/webp/' . $model->file_webp))) {
                File::delete(public_path('uploads/gallery/webp/' . $model->file_webp));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $name_webp = date('His') . '_' . Str::slug($title) . '.webp';

        $file->storeAs('gallery', $name, 'public_uploads');

        $filepath = public_path('uploads/gallery/' . $name);
        $file_path_webp = public_path('uploads/gallery/webp/' . $name_webp);

        Image::make($filepath)
            ->resize(
                config('images.gallery.big_width'),
                config('images.gallery.big_height'),
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($filepath);

        Image::make($filepath)->encode('webp', 90)->save($file_path_webp);

        $model->update(['file' => $name, 'file_webp' => $name_webp]);
    }
}
