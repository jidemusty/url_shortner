<?php

namespace App\Observers;

use App\Link;

class LinkObserver
{
    public function created(Link $link)
    {
        $link->update([
            'code' => $link->getCode()
        ]);
    }
}
