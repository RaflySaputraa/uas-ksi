<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiController extends Controller
{
    public function index()
    {
        $gajis = Gaji::with('karyawan')->get();
        return view('gajis.index', compact('gajis'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('gajis.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'periode' => 'required',
        ]);

        $karyawan = Karyawan::findOrFail($request->id_karyawan);

        $gaji = new Gaji();
        $gaji->id_karyawan = $request->id_karyawan;
        $gaji->periode = $request->periode;
        $gaji->gaji_pokok = $karyawan->gaji_pokok;
        $gaji->tunjangan = $karyawan->tunjangan;
        $gaji->potongan = $karyawan->potongan;
        $gaji->total_gaji = $gaji->gaji_pokok + $gaji->tunjangan - $gaji->potongan;
        $gaji->status = 'Belum Dibayar';
        $gaji->save();

        return redirect()->route('gajis.index')->with('success', 'Data gaji berhasil ditambahkan');
    }
}
