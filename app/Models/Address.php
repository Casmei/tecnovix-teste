<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip_code',
        'street',
        'complement',
        'unit',
        'neighborhood',
        'city',
        'state',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
