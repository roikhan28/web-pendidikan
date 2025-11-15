<?php
// app/Http/Controllers/Siswa/DashboardController.php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Exam;

class DashboardController extends Controller
{
    public function index()
    {
        $kelasId = auth()->user()->kelas_id;
        $schedules = Schedule::with(['kelas','subject'])->where('kelas_id',$kelasId)
            ->orderBy('day_of_week')->orderBy('start_time')->get();

        $exams = Exam::with('subject')->whereHas('subject', fn($q)=>$q->where('kelas_id',$kelasId))
            ->orderBy('date')->get();

        return view('siswa.dashboard', compact('schedules','exams'));
    }
}
