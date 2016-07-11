<?php

namespace App\Model;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Model;
#use SleepingOwl\Admin\Traits\OrderableModel;
use Illuminate\Http\UploadedFile;
#use App\Model\Catalog;

class Product extends Model
{
 	use Upload;
 	
    protected $fillable = ['title', 'slug', 'description', 'content', 'avatar', 'photo', 'catalog_id'];


    protected $casts = [
        'avatar' => 'image',
        'photo' => 'image',
    ];
    


    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }


    public function getPhotoAttribute($value)
    {
        return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
        #return explode(',', $value);
    }

    public function setPhotoAttribute($photo)
    {
        $this->attributes['photo'] = implode(',', $photo);
    }

}
