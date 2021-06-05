<?php

namespace App\Service\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class MediaLibraryUpload implements \Support\Media\Contracts\Upload
{
    /**
     * @param string $data
     * @return mixed
     */
    public function getDropzoneData(string $data)
    {
        return json_decode($data, true);
    }

    /**
     * Store media to media temp folder and return path
     *
     * @param UploadedFile|UploadedFile[]|null $uploadedFile
     * @param $store_path
     * @param bool $get_path_only
     * @return array|string|null
     */
    public function store($uploadedFile, $store_path, $get_path_only = true)
    {
        if ($uploadedFile->isValid()) {
            $path          = $uploadedFile->store($store_path, 'public');
            $original_name = $uploadedFile->getClientOriginalName();

            if ($get_path_only) return $path;

            return [$path, $original_name];

        } else {
            throw new UploadException("Uploaded file is not valid.");
        }
    }

    public function makeDropzoneData($resource = null, $max_size = 2, $max_file = 1, $acc_exts = ['.jpg', '.jpeg', '.png'], $collection = 'default'): ?array
    {
        $dropzone_data = [];

        $site_url = URL::to('/');

        if ($resource && $resource->hasMedia($collection)) {
            foreach ($resource->getMedia($collection) as $item) {
                $file_path       = str_replace($site_url, '', $item->getUrl());
                $dropzone_data[] = ['name' => $item->name, 'src' => $file_path, 'uuid' => $item->uuid, 'size' => $item->size]; // name, src, uuid, size
            }
        }

        $file_data = [
            'attrs' => [
                'max_size'  => $max_size,
                'max_files' => $max_file,
                'acc_exts'  => $acc_exts,
            ],
            'data'  => $dropzone_data,
        ];

        return $file_data;
    }

    public function AddPhotoToResource($resource, $src, $name, $collection = 'default')
    {
        $resource->addMedia($src)
            ->usingName($name)
            ->toMediaCollection($collection, 'photos');

        return $resource;
    }
}
