@extends('layouts.app')

@section('content')
    <h1>Buat Gaji</h1>

    <form action="{{ route('gajis.store') }}" method="POST">
        @csrf

        <div>
            <label for="karyawan_id">Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" required>
        </div>

        <div>
            <label for="jumlah">Jumlah Gaji</label>
            <input type="number" name="jumlah" id="jumlah" required>
        </div>

        <div>
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan"></textarea>
        </div>

        <div>
            <button type="submit">Simpan</button>
            <button type="submit" name="another" value="1">Simpan & Tambah Lagi</button>
            <a href="{{ route('gajis.index') }}">Batal</a>
        </div>
    </form>
@endsection
