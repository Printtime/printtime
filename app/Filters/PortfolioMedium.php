<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PortfolioMedium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(400);
        #return $image->resize(400, 400);
        #return $image->resizeCanvas(400, 400, 'center');
    }
}