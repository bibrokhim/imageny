<?php

namespace App\Services;

use App\Models\Folder;
use App\Models\Image;

class Breadcrumbs
{
    public static function make(Folder $folder, ?Image $image = null): array
    {
        $breadcrumbs = [['title' => $folder->name]];

        while ($folder->parent) {
            $folder = $folder->parent;

            array_unshift($breadcrumbs, [
                'title' => $folder->name,
                'link' => route('folders.show', $folder)
            ]);
        }

        return $breadcrumbs;
    }

    public static function makeForImage(Image $image): array
    {
        $folder = $image->folder;
        $breadcrumbs = [
            [
                'title' => $folder->name,
                'link' => route('folders.show', $folder)
            ]
        ];

        while ($folder->parent) {
            $folder = $folder->parent;

            array_unshift($breadcrumbs, [
                'title' => $folder->name,
                'link' => route('folders.show', $folder)
            ]);
        }

        $breadcrumbs[] = [
            'title' => $image->name . '.' . $image->extension
        ];

        return $breadcrumbs;
    }
}