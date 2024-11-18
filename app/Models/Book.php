<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'isbn',
        'gender',
        'author_id',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }


}
