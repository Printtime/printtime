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


    public function getPostpress()
    {
        return $this->morphToMany(Postpress::class, 'postpressgable', 'postpressgables',  'postpress_id', 'postpressgable_id')->withPivot('var');
    }

    public function getPostpressArr()
    {
        $arr = $this->morphToMany(Postpress::class, 'postpressgable', 'postpressgables',  'postpress_id', 'postpressgable_id')->withPivot('var')->pluck('var')->toArray();
        return array_values($arr);
    }

    public function postpress()
    {
        return $this->morphToMany(Order::class, 'postpressgable', 'postpressgables',  'postpress_id', 'postpressgable_id')->withPivot('var');
    }

}
