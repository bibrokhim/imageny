<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Folder;
use App\Models\Image;
use App\Services\Breadcrumbs;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function upload(Request $request, Folder $folder)
    {
        foreach ($request->images as $image) {
             $imageModel = Image::create([
                'folder_id' => $folder->id,
                'name' => ImageService::nameWithoutExtension($image->getClientOriginalName()),
                'size' => $image->getSize(),
            ]);
             $imageModel->path = ImageService::storeImage($image, $imageModel->id, $folder);
             $imageModel->extension = ImageService::extension($imageModel->path);
             $imageModel->save();

            ImageService::generateFormats($imageModel);
        }
    }

    public function show(Image $image)
    {
        return Inertia::render('ImageShow', [
            'image' => ImageResource::make($image),
            'breadcrumbs' => Breadcrumbs::makeForImage($image)
        ]);
    }

    public function update(Request $request, Image $image)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:25']
        ]);

        $image->name = $attributes['name'];
        $image->save();
    }

    public function destroy(Image $image)
    {
        ImageService::deleteImage($image);

        $image->delete();
    }
}
