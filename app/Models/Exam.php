<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id','date','start_time','end_time','location'];

    public function subject() { return $this->belongsTo(Subject::class); }
}
