<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Model\PrintFile;
use App\User;
use App\Pay;
use App\Delivery;

class Order extends Model
{
    protected $fillable = ['title', 'comment', 'count', 'width', 'height', 'sum'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

  public function files()
    {
        return $this->hasMany(PrintFile::class);
    }

  public function userfiles($side)
    {   
        #$this->side1 = $this->hasMany(PrintFile::class)->where('user_id', auth()->user()->id)->where('side', '1')->orderby('id', 'desc')->first();
        #$this->side2 = $this->hasMany(PrintFile::class)->where('user_id', auth()->user()->id)->where('side', '2')->orderby('id', 'desc')->first();
        #return $this;
        $side = $side + 1;
        return $this->hasOne(PrintFile::class)
            ->where('user_id', auth()->user()->id)
            ->where('side', $side)
            ->orderby('id', 'desc')
            ->first();

        // return $this->hasMany(PrintFile::class)
        // ->where('user_id', auth()->user()->id)
        // ->orderby('id', 'desc')
        // ->groupBy('side')
        // ->groupBy('id');
    }

  public function printerfiles()
    {
        return $this->hasMany(PrintFile::class)->where('confirmed', '1')->whereNotNull('server_id')->orderby('side', 'asc');
    }

  public function user()
    {
        return $this->belongsTo(User::class);
    }

  public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'id', 'order_id');
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
            
                $pay = new Pay();
                $pay->status = 'local';
                $pay->user_id = $user->id;
                $pay->amount = $this->sum; 
                $pay->type = 'sell';
                $pay->description = 'Списание '.$this->sum.' за заказ №'.$this->id.'';
                $pay->save();

            return true;
        }
        return false;
    }
    
    public function payBack() {
        $user = User::find($this->user_id);
        $user->balance = $user->balance + $this->sum;
        $user->save();

                $pay = new Pay();
                $pay->status = 'local';
                $pay->user_id = $user->id;
                $pay->amount = $this->sum; 
                $pay->type = 'buy';
                $pay->description = 'Зачисление '.$this->sum.' по заказу №'.$this->id.'';
                $pay->save();    
                   
        return true;
    }
    
    public function setStatus($new_status_id) 
    {   
        $this->status_id = (int)$this->status_id;
        $new_status_id = (int)$new_status_id;

            $rulesStatus = collect([
                ['status' => 8, 'new_status' => 1, 'function' => 'payAdd'],
                ['status' => 1, 'new_status' => 8, 'function' => 'payBack'],
                ['status' => 1, 'new_status' => 7, 'function' => 'payBack'],
                ['status' => 2, 'new_status' => 7, 'function' => 'payBack'],
                ['status' => 2, 'new_status' => 8, 'function' => 'payBack'], // В работе -> Ждет оплаты
                ['status' => 7, 'new_status' => 2, 'function' => 'payAdd'], // Отмена -> В работе
            ]);
            $rulesStatus = $rulesStatus->where('status', $this->status_id)->where('new_status', $new_status_id);


            if($rulesStatus->first()['function']) {
                $function = $rulesStatus->first()['function'];
                $this->$function();
            }

            $this->status_id = $new_status_id;
            $this->save();
    }


}
