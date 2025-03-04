<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use SoftDeletes, HasFactory;
    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function note()
    {
        return $this->morphOne(Note::class, 'noteable');
    }
}
