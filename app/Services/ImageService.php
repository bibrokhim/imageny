<?php

namespace App\Services;

use App\Models\Folder;
use App\Models\Image as ImageModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService extends FileService
{
    public static function storeImage(UploadedFile $image, int $imageId, Folder $folder): string
    {
        $imagePath = $image->storeAs($folder->path(), $imageId . '.' . $image->extension());

        foreach (config('image.sizes') as $sizeName => $size) {
            Image::make(Storage::path($imagePath))
                ->resize($size[0], $size[1], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(Storage::path("$sizeName-$imageId"));
            Storage::move(
                "$sizeName-$imageId",
                "$sizeName/$imagePath"
            );
        }

        return $imagePath;
    }

    public static function deleteImage(ImageModel $image)
    {
        Storage::delete($image->path);

        foreach (array_merge(config('image.sizes')) as $sizeName => $size) {
            Storage::delete($sizeName . '/' . $image->path);
        }

        foreach (config('image.encode.formats') as $format) {
            Storage::delete(self::changeExtension($image->path, $format));

            foreach (array_merge(config('image.sizes')) as $sizeName => $size) {
                Storage::delete(self::changeExtension($sizeName . '/' . $image->path, $format));
            }
        }
    }

    public static function generateFormats(ImageModel $image): void
    {
        foreach (array_diff(config('image.encode.formats'), [$image->extension]) as $format) {
            static::generateFormat($image, $format);
        }
    }

    private static function generateFormat(ImageModel $image, $format): void
    {
        Image::make(Storage::path($image->path))
            ->encode($format, config('image.encode.quality'))
            ->save(Storage::path(self::changeExtension($image->path, $format)));

        foreach (config('image.sizes') as $sizeName => $size) {
            Image::make(Storage::path("$sizeName/$image->path"))
                ->encode($format, config('image.encode.quality'))
                ->save(Storage::path(self::changeExtension("$sizeName/$image->path", $format)));
        }
    }

    public static function resolution(string $path): array
    {
        $image = Image::make(Storage::path($path));
        return [$image->width(), $image->height()];
    }
}