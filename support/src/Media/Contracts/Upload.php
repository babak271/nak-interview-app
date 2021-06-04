<?php

namespace Support\Media\Contracts;

use Illuminate\Http\UploadedFile;

interface Upload
{
    /**
     * @param string $data
     * @return mixed
     */
    public function getDropzoneData(string $data);

    /**
     * Store media to media temp folder and return path
     *
     * @param UploadedFile|UploadedFile[]|null $uploadedFile
     * @param $store_path
     * @param bool $get_path_only
     * @return array|string|null
     */
    public function store($uploadedFile, $store_path, $get_path_only = true);

    public function makeDropzoneData($resource = null, $max_size = 2, $max_file = 1, $acc_exts = ['.jpg', '.jpeg', '.png'], $collection = 'default'): ?array;

    public function AddPhotoToResource($resource, $src, $name, $collection = 'default');
}