<?php

namespace App\TothBoard\Model;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
	protected $casts = [
        'project_tree' => 'array',
    ];

    public function canvases()
    {
        return $this->hasMany('App\TothBoard\Model\Canvas');
    }
}

?>