@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Mata Kuliah</th>
            <th>Gambar</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 0; @endphp
        @foreach ($mahasiswas as $mahasiswa)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $mahasiswa->nama }}</td>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->mata_kuliah }}</td>
            <td><img src="{{ asset($mahasiswa->gambar) }}" width="100" height="100"></td>
            <td>
                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('mahasiswa.show', $mahasiswa->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $mahasiswa->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <h2 class="mt-5">Ambil Gambar dengan Kamera</h2>
    <div id="camera" class="mt-3"></div>
    <button id="take-snapshot" class="btn btn-primary mt-3">Ambil Gambar</button>
    <canvas id="snapshot" style="display: none;"></canvas>
    <form id="snapshot-form" action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="hidden" name="nama" value="Sample Name">
        <input type="hidden" name="nim" value="Sample NIM">
        <input type="hidden" name="mata_kuliah" value="Sample Mata Kuliah">
        <input type="hidden" name="gambar" id="snapshot-input">
        <button type="submit" class="btn btn-success">Simpan Gambar</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Initialize the camera
    const camera = document.getElementById('camera');
    const snapshot = document.getElementById('snapshot');
    const snapshotForm = document.getElementById('snapshot-form');
    const snapshotInput = document.getElementById('snapshot-input');
    const takeSnapshotButton = document.getElementById('take-snapshot');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            camera.srcObject = stream;
            camera.play();
        });

    takeSnapshotButton.addEventListener('click', () => {
        const context = snapshot.getContext('2d');
        snapshot.width = camera.videoWidth;
        snapshot.height = camera.videoHeight;
        context.drawImage(camera, 0, 0, snapshot.width, snapshot.height);
        snapshot.style.display = 'block';

        // Convert snapshot to base64
        snapshotInput.value = snapshot.toDataURL('image/png');
        snapshotForm.style.display = 'block';
    });
</script>
@endsection
