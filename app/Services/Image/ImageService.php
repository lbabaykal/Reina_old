<?php

namespace App\Services\Image;

use Intervention\Image\ImageManager;

class ImageService extends AbstractImage
{
    public $image;

    public function __construct()
    {
        $this->setFormat(config('image.format') ?? 'webp');
        $this->setStorage(config('image.storage') ?? 'images');
    }

    public function save(): null|string
    {

        if (! request()->hasFile($this->fileField)) {
            return null;
        }

        $this->checkOrCreateDir();

        switch ($this->format) {
            case 'webp':
                $this->image = ImageManager::gd()
                    ->read(request()->file($this->fileField))
                    ->toWebp(100)
                    ->toFilePointer();
                break;
            case 'jpeg':
                $this->image = ImageManager::gd()
                    ->read(request()->file($this->fileField))
                    ->toJpeg(100)
                    ->toFilePointer();
                break;
            case 'png':
                $this->image = ImageManager::gd()
                    ->read(request()->file($this->fileField))
                    ->toPng()
                    ->toFilePointer();
                break;
            default:
                return null;
        }

        $this->fileName = "{$this->generateUrl()}.{$this->format}";
        $this->disk->put($this->fileName, $this->image);

        return $this->fileName;
    }

}
