@if(session('message'))
<div class="alert alert-success alert-dismissible fade show w-200" role="alert">
    <strong>Berhasil !</strong> Berhasil Absen  {{ $status }} Siswa $siswa
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif