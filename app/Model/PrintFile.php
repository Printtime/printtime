<?php

namespace App\Model;

use App\Model\Servers;
use Illuminate\Database\Eloquent\Model;

class PrintFile extends Model
{
    protected $fillable = ['name', 'extension', 'filename', 'size', 'order_id', 'status_id', 'side', 'server_id'];
    

    public function server()
    {
        return $this->belongsTo(Servers::class, 'server_id');
    
       # return $this->belongsTo(Variable::class, 'type_var', 'var_id', 'type_id')->withPivot('price', 'quantity');
    }
}
