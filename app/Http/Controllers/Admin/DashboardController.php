<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Exam;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'users' => User::count(),
            'kelas' => Kelas::count(),
            'subjects' => Subject::count(),
            'schedules' => Schedule::count(),
            'exams' => Exam::count(),
        ];
        return view('admin.dashboard', compact('counts'));
    }
}
