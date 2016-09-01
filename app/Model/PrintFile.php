<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrintFile extends Model
{
<<<<<<< HEAD
    protected $fillable = ['file', 'OriginalName', 'OriginalExtension', 'order_id', 'status_id', 'side'];
=======
    protected $fillable = ['name', 'extension', 'filename', 'size', 'order_id', 'status_id', 'side'];
>>>>>>> fae5d7c2a9f7a2ad25c6110fc4d08486ca13a5e0

}
