<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Folder;
use App\Models\Image;
use App\Models\User;
use App\Services\FileService;
use App\Services\ImageService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folder = Folder::inRandomOrder()->first();

        Image::factory()
            ->for($folder)
            ->count(4)
            ->create()->map(function ($image) use ($folder) {
                $uploadedFile = UploadedFile::fake()->image($image->name . '.jpg');
                $image->path = ImageService::storeImage($uploadedFile, $image->id, $folder);
                $image->size = $uploadedFile->getSize();
                $image->extension = 'jpg';
                $image->save();
                ImageService::generateFormats($image);
            });
    }
}
