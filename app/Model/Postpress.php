<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Postpress extends Model
{	
	protected $table = 'postpress';
    protected $fillable = ['name', 'label', 'f', 'view'];
    


   // public function order()
   //  {
   //      return $this->morphedByMany(Order::class, 'taggable');
   //  }

}