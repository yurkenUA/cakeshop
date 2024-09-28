<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'altname',
        'path',
        'x1600',
    ];

    protected function getHtmlAttribute() {
        return '<img alt="'. $this->altname .'" src="'. $this->path .'" srcset="'.$this->x1600.' w1600" />';
    }

    // fname
    // lname
    // full_name = getFullNameAttribute > trim(fname.' '.lname);

    // in view
    // {!! $image->html !!}
}
