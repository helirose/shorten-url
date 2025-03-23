<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'original_url',
        'short_code'
    ];

    /**
     * Returns random string for url short code
     * Note, simple and may cause collision, would improve in future iterations probably using a library to handle this
     *
     * @return string
     */
    public static function generateShortcode($url): string
    {
        return substr(md5($url), 0, 8);
    }
}
