<?php

namespace App\Model;

use App\Model\Servers;
use App\User;
use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class PrintFile extends Model
{
    protected $fillable = ['name', 'extension', 'filename', 'size', 'order_id', 'status_id', 'side', 'server_id'];
    

    public function server()
    {
        return $this->belongsTo(Servers::class, 'server_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
