<?php

namespace App\Models;

use App\Helpers\Sanitize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;

class Certification extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];

    protected $casts = [
        'issued_at' => 'date',
        'is_published' => 'boolean',
    ];

    // Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    // Accessor: sanitized embed HTML allowing a very limited iframe
    public function getEmbedHtmlSafeAttribute(): string
    {
        $html = (string) ($this->embed_html ?? '');

        // Defer to helper; if helper missing, return empty string as a safe fallback
        if (class_exists(Sanitize::class)) {
            return Sanitize::iframe($html);
        }

        return '';
    }

    // Convenience method if called as a method in views
    public function embedHtmlSafe(): string
    {
        return $this->embed_html_safe;
    }

    protected static function booted(): void
    {
        static::saving(function (Certification $model) {
            // Generate slug if empty
            if (empty($model->slug) && ! empty($model->title)) {
                $model->slug = $model->generateUniqueSlug($model->title);
            }

            // Sanitize embed_html on save
            if (! empty($model->embed_html) && class_exists(Sanitize::class)) {
                $model->embed_html = Sanitize::iframe((string) $model->embed_html);
            }
        });
    }

    protected function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($this->exists, function ($q) {
            // When updating, ignore current record
            $q->whereKeyNot($this->getKey());
        })->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
