<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrintFile extends Model
{
    protected $fillable = ['name', 'extension', 'filename', 'size', 'order_id', 'status_id', 'side'];
}
