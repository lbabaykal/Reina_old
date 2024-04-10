<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;

class ImageServices
{
    protected $disk;
    protected $file;
    protected $fileName;

    public function saveWebp(Request $request, string $key, string $storage): string|null
    {
        if (! $request->hasFile($key)) {
            return null;
        }

        $this->checkOrCreateDir($storage);

        $image = ImageManager::gd()
            ->read($request->file($key))
            ->toWebp(100)
            ->toFilePointer();

        $this->fileName = $this->generateUrl() . '.webp';
        $this->disk->put($this->fileName, $image);

        return $this->fileName;
    }

    protected function checkOrCreateDir(string $storage): void
    {
        $this->disk = Storage::disk($storage);

        if(! $this->disk->exists(date('Y-m'))) {
            $this->disk->makeDirectory(date('Y-m'));
        }
    }

    protected function generateUrl(): string
    {
        return date('Y-m') . '/' . Str::random(40);
    }

}
