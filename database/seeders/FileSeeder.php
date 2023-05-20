<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::factory()
            ->for(User::inRandomOrder()->first())
            ->count(4)
            ->create()->map(function ($file) {
                $uploadedFile = UploadedFile::fake()->create($file->name . '.pdf', 10);
                $file->path = FileService::store($uploadedFile, $file->id);
                $file->size = $uploadedFile->getSize();
                $file->extension = 'pdf';
                $file->save();
            });
    }
}
