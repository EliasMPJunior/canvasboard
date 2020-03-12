<?php

namespace App\TothBoard\Model;

use Illuminate\Database\Eloquent\Model;


class Canvas extends Model
{
	protected $casts = [
        'content' => 'array',
    ];
}
