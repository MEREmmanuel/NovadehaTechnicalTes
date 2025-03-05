<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'position',
        'email',
        'phone'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'noteable');
    }
}
