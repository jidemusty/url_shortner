<?php

namespace App;

use App\Helpers\Math;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CodeGenerationException;

class Link extends Model
{
    protected $fillable = [
        'original_url',
        'code',
        'requested_count',
        'used_count',
        'last_requested',
        'last_used'
    ];

    protected $dates = [
        'last_requested',
        'last_used'
    ];

    public function touchTimestamp($column)
    {
        $this->{$column} = $this->freshTimestamp();
        $this->save();
    }

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
