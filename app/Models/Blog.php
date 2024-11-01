<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function generateSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 2;
        // Check if a slug with the same name already exists
        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (!isset($this->attributes['slug']) || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = static::generateSlug($value);
        }
    }
}
