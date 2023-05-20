<?php

namespace App\Http\Controllers;

use App\Http\Resources\FolderResource;
use App\Http\Resources\ImageLightResource;
use App\Models\Folder;
use App\Services\Breadcrumbs;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FolderController extends Controller
{
    public function index()
    {
        return Inertia::render('FolderIndex', [
            'folders' => FolderResource::collection(
                FolderService::rootFoldersOfCurrentUser()
            ),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => [
                'required',
                'string',
                'max:25',
                function ($attribute, $value, $fail) use($request) {
                    if (
                        Folder::where('user_id', auth()->id())
                            ->where('parent_id', $request->parent_id)
                            ->where('name', $value)
                            ->exists()
                    ) {
                        $fail("The $attribute has already been taken");
                    }
                }
            ],
            'parent_id' => ['sometimes', 'int', 'exists:folders,id'],
        ]);

        $request->user()->folders()->create($attributes);
    }

    public function show(Folder $folder)
    {
        $this->isFirstPage()
            ? $folder->load('parent', 'children')
            : $folder->load('parent');

        return Inertia::render('FolderShow', [
            'folder' => FolderResource::make($folder),
            'images' => ImageLightResource::collection(
                $folder->images()->simplePaginate(config('image.per-page'))
            ),
            'breadcrumbs' => Breadcrumbs::make($folder)
        ]);
    }

    public function update(Request $request, Folder $folder)
    {
        $attributes = $request->validate([
            'name' => [
                'required',
                'string',
                'max:25',
                function ($attribute, $value, $fail) use($request, $folder) {
                    if (
                        Folder::where('user_id', auth()->id())
                            ->where('parent_id', $folder->parent_id)
                            ->where('name', $value)
                            ->where('id', '<>', $folder->id)
                            ->exists()
                    ) {
                        $fail("The $attribute has already been taken");
                    }
                }
            ],
            'parent_id' => ['sometimes', 'int', 'exists:folders,id'],
        ]);

        $folder->name = $attributes['name'];
        $folder->save();
    }

    public function destroy(Folder $folder)
    {
        if ($folder->isEmpty()) {
            $folder->delete();
        } else {
            return back()->with([
                'message' => 'This folder contains files.',
            ]);
        }
    }

    private function isFirstPage()
    {
        return request()->isNotFilled('page') || request()->page == 1;
    }
}
