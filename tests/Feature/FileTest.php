<?php

namespace Tests\Feature;

use App\Models\File;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uploads_files()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $fileName1 = fake()->name;
        $fileName2 = fake()->name;

        $this->post(route('files.upload'), [
            'files' => [
                UploadedFile::fake()->create($fileName1 . '.pdf', 10),
                UploadedFile::fake()->create($fileName2 . '.mp4', 1024)
            ],
        ]);

        $file1 = File::where('user_id', $user->id)
            ->where('name', $fileName1)
            ->first();
        $file2 = File::where('user_id', $user->id)
            ->where('name', $fileName2)
            ->first();

        $this->assertInstanceOf(File::class, $file1);
        $this->assertInstanceOf(File::class, $file2);

        $this->assertFileExists(Storage::disk('files')->path($file1->path));
        $this->assertFileExists(Storage::disk('files')->path($file2->path));
    }

    public function test_it_deletes_file() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $file = File::factory()
            ->create(['user_id' => $user->id]);
        $uploadedFile = UploadedFile::fake()->create($file->name . '.pdf', 10);
        $file->path = FileService::store($uploadedFile, $file->id);
        $file->size = $uploadedFile->getSize();
        $file->extension = 'pdf';
        $file->save();

        $this->assertFileExists(Storage::disk('files')->path($file->path));

        $this->delete(route('files.destroy', $file));

        $this->assertTrue(File::where('id', $file->id)->doesntExist());
        $this->assertFileDoesNotExist(Storage::disk('files')->path($file->path));
    }
}
