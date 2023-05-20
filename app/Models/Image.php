<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Folder::class);
    }

    // Custom
    public function sizes($path, $extension): array
    {
        $result = [
            'original' => [
                'uri' => asset("storage/images/$path"),
                'size' => ImageService::size($path),
                'resolution' => ImageService::resolution($path),
                'extension' => $extension,
            ]
        ];

        foreach (config('image.sizes') as $sizeName => $size) {
            $result[$sizeName] = [
                'uri' => asset("storage/images/$sizeName/$path"),
                'size' => ImageService::size("$sizeName/$path"),
                'resolution' => ImageService::resolution("$sizeName/$path"),
                'extension' => $extension,
            ];
        }

        return $result;
    }

    public function formats(): array
    {
        $result = [];

        foreach (array_unique(array_merge(
                config('image.encode.formats'),
                [$this->extension]
            )) as $format)
        {
            $result[$format] = $this->sizes(
                ImageService::changeExtension($this->path, $format),
                $format
            );
        }

        return $result;
    }
}
