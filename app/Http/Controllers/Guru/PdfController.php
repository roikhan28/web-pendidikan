<?php
// app/Http/Controllers/Guru/PdfController.php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function jadwalGuru(Request $request)
    {
        $name = $request->user()->name;
        $items = Schedule::with(['kelas','subject'])
            ->whereHas('subject', fn($q)=>$q->where('teacher',$name))
            ->orderBy('day_of_week')->orderBy('start_time')->get();

        $pdf = Pdf::loadView('pdf.jadwal_guru', compact('items','name'));
        return $pdf->download('jadwal-guru.pdf');
    }
}
