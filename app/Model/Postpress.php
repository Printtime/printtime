<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Postpress extends Model
{	
  
    protected $table = 'postpress';
    protected $fillable = ['name', 'label', 'f', 'view'];

    public function getData()
    {
      $collection = $this->hasMany(PostpressData::class)->pluck('name', 'id');
    	return $collection->prepend('Нет', 0);
    }

}
