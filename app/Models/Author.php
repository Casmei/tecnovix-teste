<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
