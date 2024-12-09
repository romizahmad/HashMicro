<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Student
{
    protected $fillable = ['name', 'subjects', 'attendance', 'graduation_year'];

    public function getGraduationStatus()
    {
        return "Graduated in " . $this->graduation_year;
    }
}
