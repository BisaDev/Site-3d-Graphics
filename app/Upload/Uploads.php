<?php

namespace App\Upload;

use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

/**
 * Class Uploads
 * @package App\Uploads
 */
class Uploads
{
    /**
     * @var string
     */
    protected $imageRoute = 'uploads/images/';

    /**
     * Creates and Save (upload) a Base64 Encoded Image String
     *
     * @param $imageData
     * @param $imageRoute
     * @return string
     */
    public function uploadEncoded64Image($imageData)
    {
        $fileName = Carbon::now()->timestamp.'_'.uniqid().'.'.explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $heroImage = Image::make($imageData)->save(public_path($this->imageRoute).$fileName);

        return DIRECTORY_SEPARATOR.$this->imageRoute.$heroImage->basename;
    }
}