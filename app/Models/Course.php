<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'syllabus', 'duration'];

    public function duration(){
        return $this->duration. " Months";
    }
}