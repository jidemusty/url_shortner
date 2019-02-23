<?php

namespace App;

use App\Exceptions\CodeGenerationException;
use App\Helpers\Math;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'original_url',
        'code',
        'requested_count',
        'used_count'
    ];

    public function getCode()
    {
        if ($this->id === null) {
            throw new CodeGenerationException;
        }

        return (new Math)->toBase($this->id);
    }

    public static function byCode($code)
    {
        return static::where('code', $code);
    }

    public function shortenedUrl()
    {
        if ($this->code === null) {
            return null;
        }

        return env('CLIENT_URL') . '/' . $this->code;
    }
}
