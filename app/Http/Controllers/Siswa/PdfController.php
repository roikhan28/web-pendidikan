<?php
// app/Http/Controllers/Siswa/PdfController.php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Exam;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function jadwalSiswa(Request $request)
    {
        $kelasId = $request->user()->kelas_id;
        $jadwal = Schedule::with(['kelas','subject'])
            ->where('kelas_id',$kelasId)->orderBy('day_of_week')->orderBy('start_time')->get();

        $ujian = Exam::with('subject')->whereHas('subject', fn($q)=>$q->where('kelas_id',$kelasId))
            ->orderBy('date')->get();

        $pdf = Pdf::loadView('pdf.jadwal_siswa', compact('jadwal','ujian'));
        return $pdf->download('jadwal-siswa.pdf');
    }
}
