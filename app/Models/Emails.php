<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'message'];

    protected $table = "emails";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
