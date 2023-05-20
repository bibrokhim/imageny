<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\User;
use App\Services\FolderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class FolderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_folders_index_page()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('folders.index'));

        $response->assertStatus(200);
    }

    public function test_it_includes_users_all_parent_folders()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->actingAs($user);
        $userParentFolders = Folder::factory()
            ->count(5)
            ->create(['user_id' => $user->id])
            ->pluck('id')
            ->toArray();
        $anotherUserParentFolders = Folder::factory()
            ->count(5)
            ->create(['user_id' => $anotherUser->id])
            ->pluck('id')
            ->toArray();
        Folder::factory()
            ->count(5)
            ->create([
                'user_id' => $user->id,
                'parent_id' => Arr::random($userParentFolders)
            ]);
        Folder::factory()
            ->count(5)
            ->create([
                'user_id' => $anotherUser->id,
                'parent_id' => Arr::random($anotherUserParentFolders)
            ]);

        $folders = FolderService::rootFoldersOfCurrentUser()
            ->pluck('id')
            ->toArray();

        $this->assertEquals($userParentFolders, $folders);
    }

    public function test_it_creates_a_new_folder()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $parentFolder = Folder::factory()->create(['user_id' => $user->id]);
        $newFolderName = fake()->word();

        $this->post(route('folders.store'), [
            'name' => $newFolderName,
            'parent_id' => $parentFolder->id
        ]);

        $this->assertDatabaseHas('folders', [
            'name' => $newFolderName,
            'user_id' => $user->id,
            'parent_id' => $parentFolder->id
        ]);
    }

    public function test_it_creates_a_new_folder_with_cyrillic_symbols()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $parentFolder = Folder::factory()->create(['user_id' => $user->id]);
        $newFolderName = 'кириллица';

        $this->post(route('folders.store'), [
            'name' => $newFolderName,
            'parent_id' => $parentFolder->id
        ]);

        $this->assertDatabaseHas('folders', [
            'name' => $newFolderName,
            'user_id' => $user->id,
            'parent_id' => $parentFolder->id
        ]);
    }
}
