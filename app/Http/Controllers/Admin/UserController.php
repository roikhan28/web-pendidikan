<?php
// app/Http/Controllers/Admin/UserController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $items = User::with('kelas')->latest()->paginate(15);
        return view('admin.users.index', compact('items'));
    }
    public function create() {
        return view('admin.users.create', ['kelas'=>Kelas::all()]);
    }
    public function store(Request $r) {
        $d = $r->validate([
            'name'=>'required','email'=>'required|email|unique:users',
            'password'=>'required|min:6','role'=>'required|in:admin,guru,siswa',
            'kelas_id'=>'nullable|exists:kelas,id'
        ]);
        $d['password'] = Hash::make($d['password']);
        User::create($d);
        return redirect()->route('admin.users.index')->with('status','User dibuat');
    }
    public function edit(User $user) {
        return view('admin.users.edit', ['user'=>$user, 'kelas'=>Kelas::all()]);
    }
    public function update(Request $r, User $user) {
        $d = $r->validate([
            'name'=>'required','email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|min:6','role'=>'required|in:admin,guru,siswa',
            'kelas_id'=>'nullable|exists:kelas,id'
        ]);
        if (!empty($d['password'])) $d['password'] = Hash::make($d['password']); else unset($d['password']);
        $user->update($d);
        return back()->with('status','User diubah');
    }
    public function destroy(User $user) { $user->delete(); return back()->with('status','User dihapus'); }
}
