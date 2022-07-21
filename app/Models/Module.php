<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function permissons()
    {
       return $this->hasMany(Permission::class);
    }
}