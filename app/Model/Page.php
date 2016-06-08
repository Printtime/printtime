<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'description', 'text', 'avatar'];
}


/*namespace App\Model;

use Baum\Node;

class Page extends Node
{

}
*/