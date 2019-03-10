<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;

class LinkController extends Controller
{
   public function store(Request $request)
   {
       $this->validate($request, [
           'url' => 'required|url'
       ], [
           'url.required' => 'Please enter a URL to shorten',
           'url.url' => 'Hmm, that doesn\'t look like a valid URL'
       ]);

       $link = Link::firstorNew([
           'original_url' => $request->get('url')
       ]);

       if (!$link->exists) {
           $link->save();
       }

       $link->increment('requested_count');

       return $this->linkResponse($link);
   }
}