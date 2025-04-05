<?php

namespace Mostafaelashhab\ImageUploader;

use Illuminate\Support\ServiceProvider;

class SmartImageResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // نشر الترجمة
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'image-uploader');

        // نشر الإعدادات (إذا أردت تخصيص الصورة الافتراضية)
        $this->publishes([
            __DIR__ . '/../src/config/image-uploader.php' => config_path('image-uploader.php'),
        ], 'image-uploader-config');
    }

    public function register()
    {
        // إعداد الحزمة داخل الـ Laravel container (إن كنت بحاجة لذلك)
    }
}
