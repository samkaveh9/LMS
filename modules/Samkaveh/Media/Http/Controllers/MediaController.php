<?php

namespace Samkaveh\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samkaveh\Media\Models\Media;
use Samkaveh\Media\Services\MediaUploadService;

class MediaController extends Controller
{

    public function download(Media $media, Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        return MediaUploadService::stream($media);
    }




}