<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Subject;
use App\Models\AssignmentSubmission;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('guru_id', auth()->id())
            ->with('subject')->latest()->paginate(10);
        return view('guru.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $subjects = Subject::where('teacher', auth()->user()->name)->get();
        return view('guru.assignments.create', compact('subjects'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|file|max:4096',
            'deadline' => 'nullable|date'
        ]);

        if ($r->hasFile('file')) {
            $data['file_path'] = $r->file('file')->store('assignments', 'public');
        }

        $data['guru_id'] = auth()->id();

        Assignment::create($data);

        return redirect()->route('guru.assignments.index')->with('status', 'Tugas berhasil dibuat');
    }

    public function submissions(Assignment $assignment)
    {
        $submissions = AssignmentSubmission::with('siswa')
            ->where('assignment_id', $assignment->id)->get();

        return view('guru.assignments.submissions', compact('assignment', 'submissions'));
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return back()->with('status', 'Tugas dihapus');
    }
}
