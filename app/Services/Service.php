<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class Service
{
    /**
     * @param $file
     * @param array $params
     * @param null $oldFile
     * @param string $disk
     * @return mixed
     */
    public function uploadMedia($file, array $params = [], $oldFile = null, string $disk = 'public'): string
    {
        /** @var File $file */
        if ($oldFile) {
            $this->deleteMedia($oldFile, $disk);
        }

        $folder = $params['folder'] ?? 'images';
        $fileName = $params['filename'] ?? time() . '_' . str_replace(' ','_', $file->getClientOriginalName());

        return 'storage/' . $file->storePubliclyAs($folder, $fileName, $disk);
    }

    /**
     * @param $oldFile
     * @param string $disk
     */
    public function deleteMedia($oldFile, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($oldFile);
    }
}
