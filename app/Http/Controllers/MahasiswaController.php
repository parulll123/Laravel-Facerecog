<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Image;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'mata_kuliah' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/images');
            $image->move($path, $imageName);
            $data['gambar'] = '/images/' . $imageName;
        }

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa created successfully.');
    }
}

