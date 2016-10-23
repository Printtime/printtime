<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\PrintFile;
use App\User;

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


    public function payAdd() {
        $user = User::find($this->user_id);
        if($user->balance >= $this->sum) {
            $user->balance = $user->balance - $this->sum;
            $user->save();
            return true;
        }
        return false;
    }
    
    public function payBack() {
        $user = User::find($this->user_id);
        $user->balance = $user->balance + $this->sum;
        $user->save();
        return true;
    }
    
    public function setStatus($new_status_id) 
    {   


            $rulesStatus = collect([
                ['status' => 8, 'new_status' => 1, 'function' => 'payAdd'],
                ['status' => 1, 'new_status' => 8, 'function' => 'payBack'],
                ['status' => 1, 'new_status' => 7, 'function' => 'payBack'],
            ]);

            $rulesStatus = $rulesStatus->where('status', 1)->where('new_status', 8);
            if($rulesStatus->first()['function']) {
                $function = $rulesStatus->first()['function'];
                $this->$function();
            }
            
  } 


}
