<?php

namespace App\TothBoard\Model;

use Illuminate\Database\Eloquent\Model;


class Board extends Model
{
	protected $casts = [
        'content' => 'array',
    ];
}
