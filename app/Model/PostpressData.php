<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostpressData extends Model
{
	protected $table = 'postpress_data';
    protected $fillable = ['name'];
}
