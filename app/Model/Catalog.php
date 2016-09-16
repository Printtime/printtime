<?php

namespace App\Model;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Illuminate\Http\UploadedFile;

class Catalog extends Model
{
    use OrderableModel;
 	use Upload;

    protected $fillable = ['title', 'slug', 'description', 'content', 'avatar', 'photo'];

    protected $casts = [
        'avatar' => 'image',
        'photo' => 'image',
    ];

    public $imgPath = 'images/uploads/';

    /**
     * @return array
     */


    public function getUploadSettings()
    {
        return [
            'avatar' => [
                'orientate' => [],
                'resize' => [1280, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                }]
            ]
            
            ,
            'photo' => [
                'orientate' => [],
                'fit' => [200, 300, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                }]
            ]
            
        ];
    }



    public function setImageAttribute($value)
    {
        //move file to directory
        $imageName = last(explode('/', $value));
        File::move($value, $this->imgPath . $imageName);
    }


/**********************************************************************
     * Mutators
     **********************************************************************/
    /**
     * @param UploadedFile $file
     */

/*
    public function setUploadFileAttribute(UploadedFile $file = null)
    {
        if (is_null($file)) {
            return;
        }
        foreach ($this->getUploadFields() as $field) {
            $this->{$field.'_file'} = $file;
        }
    }
*/


    public function getPhotoAttribute($value)
    {
        return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
        #return explode(',', $value);
    }


    public function setPhotoAttribute($photo)
    {
        $this->attributes['photo'] = implode(',', $photo);
    }


    public function getOrderField()
    {
        return 'order';
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function products2order()
    {
        return $this->hasMany(Product::class)->where('order_vis', 1);
    }

}
