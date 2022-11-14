<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email'];
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];


    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id');
    }

    public function author()
    {
    	return $this->belongsTo(Author::class, 'author_id');
    }
}
