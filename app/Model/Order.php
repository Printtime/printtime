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


    public function postpress()
    {
        return $this->morphToMany(Order::class, 'postpressgable', 'postpressgables',  'postpress_id', 'postpressgable_id')->withPivot('var');
    }


    // public function pp()
    // {
    //     return $this->belongsTo(Postpress::class);
    // }

    // public function postpress()
    // {
    //     return $this->morphToMany(Postpress::class, 'postpress', 'postpressgables',  'postpress_id', 'postpressgable_id');
    // }

    // public function postpress()
    // {
    //     return $this->hasMany(Postpress::class);
    // }

    // public function postpressvar()
    // {
    //     return $this->morphToMany(Postpress::class, 'taggable');
    // }  
}
