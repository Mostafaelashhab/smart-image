<?php

namespace Mostafaelashhab\ImageUploader;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUploadable
{
    // يمكن للمستخدم تحديد الحقول يدويًا في الموديل
    // protected static $imageFields = [];

    public static function bootImageUploadable()
    {
        static::saving(function ($model) {
            // نستخدم الحقول التي حددها المستخدم
            $imageFields = $model::$imageFields;

            foreach ($imageFields as $field) {
                if (request()->hasFile($field)) {
                    // رفع الصورة إلى المجلد الخاص بها
                    $model->$field = ImageUploader::upload(request()->file($field), $model);
                } elseif (empty($model->$field)) {
                    // إذا لم توجد صورة، استخدم الصورة الافتراضية
                    $model->$field = ImageUploader::getDefaultImage($field);
                }
            }
        });
    }

    public function getImageUrlsAttribute()
    {
        $urls = [];
        // استخدام الحقول المحددة من قبل المستخدم
        $imageFields = $this::$imageFields;

        foreach ($imageFields as $field => $directory) {
            $urls[$field] = ImageUploader::getImage($this->$field);
        }

        return $urls;
    }
}
