<?php

namespace App\Media\Http\Controller;

use App\Http\Controllers\Controller;
use Support\Media\Contracts\Upload;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class MediaController extends Controller
{
    const UPLOADS_TINY = 'uploads/tiny';
    const TINY_RESPONSE_KEY = 'location';
    /**
     * @var Upload
     */
    private $uploadService;

    public function __construct()
    {
        try {
            $this->InitializeService();
        } catch (BindingResolutionException $e) {
            report($e);
            return response('Upload Service is not available');
        }
    }

    /**
     * Make instance from required repositories.
     *
     * @throws BindingResolutionException
     */
    protected function InitializeService()
    {
        $this->uploadService = app()->make(Upload::class);
    }

    /**
     * Upload photo.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadPhoto(Request $request)
    {
        return $this->uploadPhotoHandler($request, 'media_temp', 'src', 'file');
    }

    /**
     * Upload video.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadVideo(Request $request)
    {
        //
    }

    /**
     * Upload file.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadFile(Request $request)
    {
        //
    }

    /**
     * Upload tinymce photo.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadTinyPhoto(Request $request)
    {
        return $this->uploadPhotoHandler($request, self::UPLOADS_TINY . '/photos', self::TINY_RESPONSE_KEY, 'file');
    }

    /**
     * Upload tinymce media.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadTinyMedia(Request $request)
    {
        return $this->uploadVideoAudioHandler($request, self::UPLOADS_TINY . '/videos', self::TINY_RESPONSE_KEY, 'file');
    }

    /**
     * Upload tinymce file.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadTinyFile(Request $request)
    {
        return $this->uploadFileHandler($request, self::UPLOADS_TINY . '/files', self::TINY_RESPONSE_KEY, 'file');
    }

    /**
     * @param Request $request
     * @param $file_name
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getUploadPhotoValidator(Request $request, $file_name = 'file'): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($request->all(), [
            $file_name => 'required|file|mimes:jpg,jpeg,bmp,png,tiff',
        ], [
            $file_name . '.required' => __('validation.required', ['attribute' => __('crud.photo')]),
            $file_name . '.mimes'    => __('validation.mimes', ['attribute' => __('crud.photo'), 'values' => 'jpg,jpeg,bmp,png,tiff']),
        ]);
        return $validator;
    }

    /**
     * @param Request $request
     * @param $file_name
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getUploadVideoAudioValidator(Request $request, $file_name = 'file'): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($request->all(), [
            $file_name => 'required|file|mimetypes:video/mp4,audio/mpeg,audio/mp4',
        ], [
            $file_name . '.required' => __('validation.required', ['attribute' => __('crud.photo')]),
            $file_name . '.mimes'    => __('validation.mimes', ['attribute' => __('crud.photo'), 'values' => 'mp4']),
        ]);
        return $validator;
    }

    /**
     * @param Request $request
     * @param $file_name
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getUploadFileValidator(Request $request, $file_name = 'file'): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($request->all(), [
            $file_name => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            $file_name . '.required' => __('validation.required', ['attribute' => __('crud.photo')]),
            $file_name . '.mimes'    => __('validation.mimes', ['attribute' => __('crud.photo'), 'values' => 'mp4']),
        ]);
        return $validator;
    }

    /**
     * @param Request $request
     * @param string $response_path_name
     * @param string $file_name
     * @param $store_path
     * @return JsonResponse
     */
    private function uploadPhotoHandler(Request $request, $store_path, $response_path_name = 'src', $file_name = 'file'): JsonResponse
    {
        $validator = $this->getUploadPhotoValidator($request, $file_name);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $uploadedFile = $request->file($file_name);

        try {
            $uploaded_path = $this->uploadService->store($uploadedFile, $store_path);

        } catch (UploadException $uploadException) {
            return response()->json($uploadException->getMessage(), $uploadException->getCode());
        }

        return response()->json([$response_path_name => $uploaded_path]);
    }

    /**
     * @param Request $request
     * @param string $response_path_name
     * @param string $file_name
     * @param $store_path
     * @return JsonResponse
     */
    private function uploadVideoAudioHandler(Request $request, $store_path, $response_path_name = 'src', $file_name = 'file'): JsonResponse
    {
        $validator = $this->getUploadVideoAudioValidator($request, $file_name);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $uploadedFile = $request->file($file_name);

        try {
            $uploaded_path = $this->uploadService->store($uploadedFile, $store_path);

        } catch (UploadException $uploadException) {
            return response()->json($uploadException->getMessage(), $uploadException->getCode());
        }

        return response()->json([$response_path_name => $uploaded_path]);
    }

    /**
     * @param Request $request
     * @param string $response_path_name
     * @param string $file_name
     * @param $store_path
     * @return JsonResponse
     */
    private function uploadFileHandler(Request $request, $store_path, $response_path_name = 'src', $file_name = 'file'): JsonResponse
    {
        $validator = $this->getUploadFileValidator($request, $file_name);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $uploadedFile = $request->file($file_name);

        try {
            $uploaded_path = $this->uploadService->store($uploadedFile, $store_path);

        } catch (UploadException $uploadException) {
            return response()->json($uploadException->getMessage(), $uploadException->getCode());
        }

        return response()->json([$response_path_name => $uploaded_path]);
    }
}

