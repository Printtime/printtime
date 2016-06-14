<?php

namespace App\Model;

use App\Traits\Upload;
use Baum\Extensions\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

class Post extends Model
{
    use SoftDeletes;
 	use Upload;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'description',
        'avatar',
        'photo'
    ];
    
    protected $casts = [
        'avatar' => 'image',
        'photo' => 'image',
    ];
    

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
