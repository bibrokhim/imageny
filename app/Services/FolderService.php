<?php

namespace App\Services;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class FolderService
{
    public static function rootFolders(): Collection
    {
        return Folder::parents()->get();
    }

    public static function rootFoldersOfUser(User $user)
    {
        return $user->folders()->parents()->get();
    }

    public static function rootFoldersOfCurrentUser()
    {
        return self::rootFoldersOfUser(auth()->user());
    }
}