<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
		protected $fillable = ['login', 'remote_ip', 'web_remote_port', 'web_remote_dir', 'local_ip', 'web_local_port', 'web_local_dir'];

	    protected $hidden = [
	        'created_at',
	        'updated_at'
	    ];

}
