<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\Image;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uploads_image()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $folder = Folder::factory()->create(['user_id' => $user->id]);
        $imageName1 = fake()->name;
        $imageName2 = 'кириллица';

        $this->post(route('images.upload', $folder), [
            'images' => [
                UploadedFile::fake()->image($imageName1 . '.jpg'),
                UploadedFile::fake()->image($imageName2 . '.png')
            ],
        ]);

        $image1 = Image::where('folder_id', $folder->id)
            ->where('name', $imageName1)
            ->first();
        $image2 = Image::where('folder_id', $folder->id)
            ->where('name', $imageName2)
            ->first();

        $this->assertInstanceOf(Image::class, $image1);
        $this->assertInstanceOf(Image::class, $image2);

        $this->assertEquals($image1->path, $folder->path() . '/' . $image1->id . '.jpg');
        $this->assertEquals($image2->path, $folder->path() . '/' . $image2->id . '.png');

        $this->assertFileExists(Storage::path($image1->path));
        $this->assertFileExists(Storage::path($image2->path));

        foreach (config('image.sizes') as $sizeName => $size) {
            $this->assertFileExists(Storage::path($sizeName . '/' . $image1->path));
            $this->assertFileExists(Storage::path($sizeName . '/' . $image2->path));
        }
    }

    public function test_it_deletes_image() {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $folder = Folder::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $image = Image::factory()
            ->create(['folder_id' => $folder->id]);
        $uploadedFile = UploadedFile::fake()->image($image->name . '.jpg');
        $image->path = ImageService::storeImage($uploadedFile, $image->id, $folder);
        $image->size = $uploadedFile->getSize();
        $image->extension = 'jpg';
        $image->save();
        ImageService::generateFormats($image);

        $this->assertFileExists(Storage::path($image->path));
        foreach (config('image.sizes') as $sizeName => $size) {
            $this->assertFileExists(Storage::path($sizeName . '/' . $image->path));
        }

        foreach (config('image.encode.formats') as $format) {
            $this->assertFileExists(ImageService::changeExtension(Storage::path($image->path), $format));
            foreach (config('image.sizes') as $sizeName => $size) {
                $this->assertFileExists(ImageService::changeExtension(Storage::path($sizeName . '/' . $image->path), $format));
            }
        }

        $this->delete(route('images.destroy', $image));

        $this->assertTrue(Image::where('id', $image->id)->doesntExist());
        $this->assertFileDoesNotExist(Storage::path($image->path));
        foreach (config('image.sizes') as $sizeName => $size) {
            $this->assertFileDoesNotExist(Storage::path($sizeName . '/' . $image->path));
        }

        foreach (config('image.encode.formats') as $format) {
            $this->assertFileDoesNotExist(ImageService::changeExtension(Storage::path($image->path), $format));
            foreach (config('image.sizes') as $sizeName => $size) {
                $this->assertFileDoesNotExist(ImageService::changeExtension(Storage::path($sizeName . '/' . $image->path), $format));
            }
        }
    }
}
