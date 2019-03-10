<?php

namespace App\Http\Controllers;

use App\Link;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function linkResponse(Link $link)
    {
        return response()->json([
            'data' => [
                'original_url' => $link->original_url,
                'shortened_url' => $link->shortenedUrl(),
                'code' => $link->code
            ]
        ], 200);
    }
}
