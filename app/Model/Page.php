<?php namespace App\Model;

use Baum\Node;
use App\Traits\Upload;
use Illuminate\Http\UploadedFile;

class Page extends Node
{
 	use Upload;

    protected $fillable = ['title', 'description', 'text', 'avatar', 'photo'];

    protected $casts = [
        'avatar' => 'image',
        'photo' => 'image',
    ];

    public function getPhotoAttribute($value)
    {
        return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function setPhotoAttribute($photo)
    {
        $this->attributes['photo'] = implode(',', $photo);
    }

    public function get_sub_pages()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('lft');
    }
}


/*namespace App\Model;

use Baum\Node;

class Page extends Node
{

}
*/