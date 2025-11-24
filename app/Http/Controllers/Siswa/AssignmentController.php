<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $kelasId = Auth::user()->kelas_id;
        $siswaId = Auth::id();

        // Ambil semua tugas kelas
        $assignments = Assignment::whereHas(
            'subject',
            fn($q) =>
            $q->where('kelas_id', $kelasId)
        )
            ->with(['subject'])
            ->get();

        // Ambil semua submissions siswa
        $submitted = AssignmentSubmission::where('siswa_id', $siswaId)
            ->pluck('assignment_id')
            ->toArray();

        return view('siswa.assignments.index', compact('assignments', 'submitted'));
    }



    public function submit(Request $r, Assignment $assignment)
    {
        $d = $r->validate([
            'file' => 'required|file|max:4096',
        ]);

        $path = $r->file('file')->store('submissions', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'siswa_id' => $siswaId = Auth::id(),
            'file_path' => $path,
            'submitted_at' => now(),
        ]);

        return back()->with('status', 'Tugas berhasil dikumpulkan');
    }
}
