<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        return Inertia::render('FileIndex', [
            'files' => FileResource::collection(
                File::query()->simplePaginate(config('image.per-page'))
            ),
        ]);
    }

    public function upload(Request $request)
    {
        foreach ($request->allFiles()['files'] as $file) {
            $fileModel = $request->user()->files()->save(
                new File([
                    'name' => FileService::nameWithoutExtension($file->getClientOriginalName()),
                    'size' => $file->getSize(),
                ])
            );

            $fileModel->path = FileService::store($file, $fileModel->id);
            $fileModel->extension = FileService::extension($fileModel->path);
            $fileModel->save();
        }
    }

    public function update(Request $request, File $file)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:25']
        ]);

        $file->name = $attributes['name'];
        $file->save();
    }

    public function destroy(File $file)
    {
        FileService::delete($file);

        $file->delete();
    }
}
