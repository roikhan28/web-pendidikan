<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'subject_id',
        'guru_id',
        'title',
        'description',
        'file_path',
        'deadline'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
