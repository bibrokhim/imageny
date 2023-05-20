<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function store(UploadedFile $file, int $fileId): string
    {
        return $file->storeAs(
            auth()->id(),
            $fileId . '.' . $file->extension(),
            'files'
        );
    }

    public static function delete(File $file)
    {
        Storage::disk('files')->delete($file->path);
    }

    public static function nameWithoutExtension($name): string
    {
        $pos = mb_strrpos($name, '.');
        if ($pos !== false) {
            return mb_substr($name, 0, $pos);
        }

        return $name;
    }

    public static function extension($name): string
    {
        $pos = mb_strrpos($name, '.');
        if ($pos !== false) {
            return mb_substr($name, $pos + 1);
        }

        return '';
    }

    public static function changeExtension($path, $format): string
    {
        return self::nameWithoutExtension($path) . ".$format";
    }

    public static function size(string $path): string
    {
        return self::calculateSize(Storage::size($path));
    }

    public static function calculateSize(int|float $sizeInBytes): string
    {
        if ($sizeInBytes >= 1024 * 1024 * 1024) {
            return round($sizeInBytes / (1024 * 1024 * 1024), 2) . ' GB';
        } elseif ($sizeInBytes >= 1024 * 1024) {
            return round($sizeInBytes / (1024 * 1024), 2) . ' MB';
        } elseif ($sizeInBytes >= 1024) {
            return round($sizeInBytes / (1024), 2) . ' KB';
        } else {
            return round($sizeInBytes, 2) . ' B';
        }
    }
}