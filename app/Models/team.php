<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Blog()
    {
        return $this->hasMany(Blog::class);
    }
    public function Project()
    {
        return $this->hasMany(project::class);
    }
}
