<?php

namespace App\TothBoard\Model;

use Illuminate\Database\Eloquent\Model;


class TypeOfCanvas extends Model
{
	protected $table = 'type_of_canvas';
	protected $connection = 'mysql_config';

	protected $casts = [
        'content' => 'array',
    ];
}
