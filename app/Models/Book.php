<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'isbn',
        'year_of_publication',
        'author_id',
        'image_path'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Scope a query to search for books by title or author name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $searchTerm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, ?string $searchTerm): Builder
    {
        if ($searchTerm) {
            return $query->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereHas('author', function ($query) use ($searchTerm) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                    });
            });
        }

        return $query;
    }
}
