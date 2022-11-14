<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email'];
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];



    public function author_books()
    {
    	return $this->hasMany(Book::class, 'author_id');
    }
}
