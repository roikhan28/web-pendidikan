<?php
// app/Http/Controllers/Admin/PdfController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Exam;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function jadwalKelas(Kelas $kelas)
    {
        $schedules = $kelas->subjects()->with(['schedules'=>fn($q)=>$q->orderBy('day_of_week')->orderBy('start_time')])->get();
        $pdf = Pdf::loadView('pdf.jadwal_kelas', compact('kelas','schedules'));
        return $pdf->download('jadwal-kelas-'.$kelas->name.'.pdf');
    }

    public function jadwalUjian()
    {
        $exams = Exam::with('subject.kelas')->orderBy('date')->get();
        $pdf = Pdf::loadView('pdf.jadwal_ujian', compact('exams'));
        return $pdf->download('jadwal-ujian.pdf');
    }
}
