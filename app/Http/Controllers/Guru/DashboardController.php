<?php
// app/Http/Controllers/Guru/DashboardController.php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Exam;

class DashboardController extends Controller
{
    public function index()
    {
        $name = auth()->user()->name;
        $schedules = Schedule::with(['kelas','subject'])
            ->whereHas('subject', fn($q)=>$q->where('teacher',$name))
            ->orderBy('day_of_week')->orderBy('start_time')->limit(20)->get();

        $exams = Exam::with('subject.kelas')->whereHas('subject', fn($q)=>$q->where('teacher',$name))
            ->orderBy('date')->limit(10)->get();

        return view('guru.dashboard', compact('schedules','exams'));
    }
}
