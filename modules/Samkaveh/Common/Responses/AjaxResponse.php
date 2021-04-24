<?php

namespace Samkaveh\Common\Responses;

use Illuminate\Http\Response;

class AjaxResponse
{

    public static function SuccessResponse()
    {
        return response()->json(['message' => 'عملیات با موفقیت انجام شد'], Response::HTTP_OK);
    }

    public static function FailResponse()
    {
        return response()->json(['message' => 'مشکلی رخ داده'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }





}
