<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawans.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        Karyawan::create($validated);

        if ($request->has('another')) {
            return redirect()->route('karyawans.create')->with('success', 'Berhasil ditambahkan, tambah lagi.');
        }

        return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    // Tambahkan edit, update, destroy jika perlu
}

