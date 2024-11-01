<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pyq extends Model
{
    use HasFactory;
    protected $table = 'pyq';
    protected $fillable = ['department', 'semester', 'subject_type', 'title', 'year', 'file'];

}