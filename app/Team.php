<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email'];
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
}
