<?php

namespace Samkaveh\Category\Responses;

use Illuminate\Http\Response;

class AjaxResponse
{

    public static function SuccessResponse()
    {
        return response()->json(['message' => 'آیتم مورد نظر با موفقیت حذف شد'], Response::HTTP_OK);
    }
}
