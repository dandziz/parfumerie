<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageUploadTrait
{
    protected string $path = 'app/public/images/';

    public function uploadImages($name, $id, $img, $i, $folderName, $width_scale = NULL,
                                 $height_scale = NULL, $subFolder = NULL, $img_name = NULL): array
    {
        $manager = new ImageManager(new Driver());
        $image_name = $this->randomImageName($name, $img, $i);
        if ($img_name) {
            $image_name = $img_name;
        }
        if (!$subFolder) {
            $link = $folderName.'/'.$id.'/'.$image_name;
        } else {
            $link = $folderName.'/'.$id.'/'.$subFolder.'/'.$image_name;
        }
        $images = $manager->read($img->getRealPath());
        if ($width_scale && $height_scale) {
            $images->resize($images->width() * $width_scale, $images->height() * $height_scale);
        }
        $images->save(storage_path($this->path.$link), 100);

        return [
            'name' => $image_name,
            'link' => $link
        ];
    }

    protected function randomImageName($imageName, $image, $i): string
    {
        return Str::slug($imageName) . time() . '-' . $i . '.' . $image->getClientOriginalExtension();
    }
}
