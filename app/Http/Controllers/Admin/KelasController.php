<?php
// app/Http/Controllers/Admin/KelasController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() { $items = Kelas::latest()->paginate(10); return view('admin.kelas.index', compact('items')); }
    public function create() { return view('admin.kelas.create'); }
    public function store(Request $r) { $d = $r->validate(['name'=>'required']); Kelas::create($d); return redirect()->route('admin.kelas.index')->with('status','Kelas dibuat'); }
    public function edit(Kelas $kela) { return view('admin.kelas.edit', ['item'=>$kela]); }
    public function update(Request $r, Kelas $kela) { $d = $r->validate(['name'=>'required']); $kela->update($d); return back()->with('status','Kelas diubah'); }
    public function destroy(Kelas $kela) { $kela->delete(); return back()->with('status','Kelas dihapus'); }
}
