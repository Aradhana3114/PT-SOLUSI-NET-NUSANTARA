<?php

namespace App\Filament\Support;

use Filament\Forms\Components\FileUpload;

class ImageUpload
{
    /**
     * Upload gambar standar: disimpan ke disk public, dan diperkecil di browser
     * sebelum dikirim sehingga foto besar dari kamera tidak gagal karena
     * batas upload_max_filesize / post_max_size PHP.
     */
    public static function make(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->image()
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
            ->maxSize(10240)
            ->disk('public')
            ->directory($directory)
            ->visibility('public')
            ->automaticallyResizeImagesMode('contain')
            ->automaticallyResizeImagesToWidth('1920')
            ->automaticallyResizeImagesToHeight('1920')
            ->automaticallyUpscaleImagesWhenResizing(false)
            ->imagePreviewHeight('150')
            ->openable();
    }
}
