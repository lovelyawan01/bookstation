<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email'];
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
}
