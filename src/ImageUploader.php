<?php

namespace Mostafaelashhab\ImageUploader;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function upload($value, $model)
    {
        // رفع صورة واحدة
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            return $value->store($model->getTable() . 'images', 'public');
        }
        return $value;
    }

    public static function getImage($imagePath)
    {
        // إرجاع رابط الصورة
        return Storage::url($imagePath);
    }

    public static function getDefaultImage()
    {
        // إرجاع رابط الصورة الافتراضية
        return Storage::url('images/default.png');
    }
}
