<?php

namespace App\Model;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;
use Illuminate\Http\UploadedFile;

class Slider extends Model
{
    use OrderableModel;
 	use Upload;
    
    protected $fillable = ['title', 'link', 'slider'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

  /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'slider' => 'image',
        #'thumb' => 'image',
    ];


    public $imgPath = 'images/uploads/';

    /**
     * @return array
     */
    public function getUploadSettings()
    {
        return [
            'slider' => [
                'orientate' => [],
                'resize' => [1280, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                }]
            ]
            /*,
            'thumb' => [
                'orientate' => [],
                'fit' => [200, 300, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                }]
            ]*/
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
    public function setUploadFileAttribute(UploadedFile $file = null)
    {
        if (is_null($file)) {
            return;
        }
        foreach ($this->getUploadFields() as $field) {
            $this->{$field.'_file'} = $file;
        }
    }






    public function getOrderField()
    {
        return 'order';
    }
}
