<?php

namespace Modules\Teacher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'number'];

    protected static function newFactory()
    {
        return \Modules\Teacher\Database\factories\TeacherFactory::new();
    }
}
