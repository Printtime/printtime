<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrintFile extends Model
{
    protected $fillable = ['file', 'OriginalName', 'OriginalExtension', 'order_id', 'status_id', 'side'];

}
