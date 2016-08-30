<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\PrintFile;

class Order extends Model
{
    protected $fillable = ['title', 'comment', 'count', 'width', 'height', 'sum'];

  public function files()
    {
        return $this->hasMany(PrintFile::class);
    }

    public function typevar()
    {
        return $this->belongsTo(TypeVar::class, 'type_var_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
