<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $connection = 'mysql';
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email'];
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];


    public function books()
    {
    	return $this->hasMany(Book::class, 'category_id');
    }
}
