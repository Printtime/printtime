<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
#use App\Model\TypeVar;

class Type extends Model
{
	protected $table = 'types';
    protected $fillable = ['title', 'product_id', 'width', 'height'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    // public function variables()
    // {
	   //  return $this->belongsToMany(TypeVar::class, 'type_var', 'type_id', 'var_id')->withPivot('price', 'quantity');
    // }
}
