<?php

namespace App\Services;


use App\Enums\PerfumeImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageService {
    use ImageUploadTrait;

    public function storeProductImages($images, $perfume, $i = 1): void
    {
        if (!Storage::exists('public/images/perfumes/'.$perfume->id)) {
            Storage::makeDirectory('public/images/perfumes/'.$perfume->id);
        }
        if (!Storage::exists('public/images/perfumes/'.$perfume->id.'/thumb')) {
            Storage::makeDirectory('public/images/perfumes/'.$perfume->id.'/thumb');
        }
        foreach ($images as $image) {
            $img = $this->uploadImages($perfume->name, $perfume->id, $image, $i, 'perfumes');

            $perfume->media()->create([
                'name' => $img['name'],
                'img' => $img['link'],
                'thumb' => $this->uploadImages($perfume->name, $perfume->id, $image, $i,
                    'perfumes', 0.5, 0.5, 'thumb', $img['name'])['link'],
                'type' => PerfumeImage::Default,
                'img_sort' => $i,
            ]);
            $i++;
        }
    }

    public function unlinkImage($img_link, $thumb_link): void
    {
        if (File::exists('storage/images/'.$img_link)) {
            unlink('storage/images/'.$img_link);
        }
        if (File::exists('storage/images/'.$thumb_link)) {
            unlink('storage/images/'.$thumb_link);
        }
    }
}
