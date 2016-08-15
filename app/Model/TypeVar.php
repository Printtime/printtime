<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TypeVar extends Model
{
	protected $table = 'type_var';
    protected $fillable = ['price', 'quantity'];
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class, 'var_id');
    
       # return $this->belongsTo(Variable::class, 'type_var', 'var_id', 'type_id')->withPivot('price', 'quantity');
    }
}
