<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Scopes
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Custom
    public function isEmpty(): bool
    {
        return (! $this->hasChildFolder()) && (! $this->hasImage());
    }

    public function hasChildFolder(): bool
    {
        return Folder::where('parent_id', $this->id)->exists();
    }

    public function hasImage(): bool
    {
        return Image::where('folder_id', $this->id)->exists();
    }

    public function path(): string
    {
        return $this->user_id . '/' . $this->id;
    }
}
