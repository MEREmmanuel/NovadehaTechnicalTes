<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use SoftDeletes, HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'noteable');
    }
}
