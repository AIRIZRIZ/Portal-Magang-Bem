@extends('layouts.admin')

@section('admin_content')
<div class="container-fluid px-0">

    {{-- HEADER SECTION --}}
    <div class="page-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5 p-4 border-4 border-dark" style="box-shadow: 6px 6px 0px;">
        <div>
            <h1 class="fw-black text-uppercase m-0 tracking-tight" style="font-weight: 900; font-size: 2rem;">
                <strong>MANAJEMEN LOWONGAN MAGANG</strong>
            </h1>
            <p class="fw-bold text-dark m-0 small opacity-75">Sistem Internal BEM-FT • Tambah, edit, dan hapus info kemitraan magang mahasiswa.</p>
        </div>
        <div>
            <button type="button" class="btn btn-light rounded-0 px-4 py-2.5 text-uppercase border-4 border-dark fw-black btn-brutal-white shadow-none" data-bs-toggle="modal" data-bs-target="#modalTambahMagang">
                <strong><i class="bi bi-plus-square-fill me-2"></i>Tambah Lowongan</strong>
            </button>
        </div>
    </div>

    {{-- FILTER FORM --}}
    <div class="mb-4">
        <form action="{{ route('admin.magang.index') }}" method="GET" class="row g-2">
            <div class="col-12 col-md-4">
                <div class="input-group border-4 border-dark bg-white" style="box-shadow: 4px 4px 0px var(--shadow-color);">
                    <span class="input-group-text bg-white border-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-0 fw-semibold shadow-none" placeholder="Cari perusahaan, posisi, lokasi..." value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.magang.index') }}" class="btn bg-white border-0 text-danger d-flex align-items-center"><i class="bi bi-x-circle-fill"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-dark rounded-0 w-100 h-100 text-uppercase border-4 border-dark fw-bold btn-brutal-dark shadow-none">
                    <strong>Filter</strong>
                </button>
            </div>
        </form>
    </div>

    {{-- TABLE DATA --}}
    <div class="table-wrapper border-4 border-dark table-responsive" style="box-shadow: 8px 8px 0px ;">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-dark text-white border-bottom border-4 border-dark">
                <tr class="text-uppercase fw-black small">
                    <th class="py-3 text-center text-white" style="background-color: #101820; width: 70px;">No</th>
                    <th class="py-3 text-white" style="background-color: #101820; width: 100px;">Logo</th>
                    <th class="py-3 text-white" style="background-color: #101820;">Perusahaan & Posisi</th>
                    <th class="py-3 text-white" style="background-color: #101820;">Kategori Prodi</th>
                    <th class="py-3 text-white" style="background-color: #101820; width: 140px;">Status Hubungan</th>
                    <th class="py-3 text-center text-white" style="background-color: #101820; width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="fw-bold small text-dark">
                @forelse($magangs as $index => $item)
                    <tr class="border-bottom border-2 border-dark">
                        <td class="text-center py-3 bg-light border-end border-2 border-dark">
                            {{ $magangs->firstItem() + $index }}
                        </td>
                        <td class="text-center">
                            @if($item->logo)
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo" class="border-2 border-dark p-1 bg-white" style="width: 55px; height: 55px; object-fit: contain;">
                            @else
                                <div class="border-2 border-dark bg-light text-muted d-flex align-items-center justify-content-center mx-auto" style="width: 55px; height: 55px; font-size: 1.5rem;">
                                    <i class="bi bi-building"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="text-uppercase text-danger d-block tracking-wider fw-black" style="font-size: 0.75rem;">{{ $item->nama_perusahaan }}</span>
                            <span class="text-dark fs-6 d-block mt-0.5">{{ $item->posisi_magang }}</span>
                            <span class="text-muted d-block small mt-0.5"><i class="bi bi-geo-alt-fill text-muted"></i> {{ $item->lokasi }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @if($item->prodis && $item->prodis->count() > 0)
                                    @foreach($item->prodis as $prodi)
                                        <span class="badge prodi-badge border border-dark px-2 py-1" style="font-size: 0.7rem;">
                                            {{ optional($prodi)->nama_prodi ?? 'Data Rusak' }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted small">Tidak ada prodi</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($item->status_mitra == 'mitra')
                                <span class="badge bg-success text-white border-2 border-dark px-2 py-1.5 text-uppercase w-100 text-center rounded-0" style="font-size: 0.65rem; letter-spacing: 0.5px;">Mitra Resmi</span>
                            @else
                                <span class="badge bg-secondary text-white border-2 border-dark px-2 py-1.5 text-uppercase w-100 text-center rounded-0" style="font-size: 0.65rem; letter-spacing: 0.5px;">Umum / Non</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning rounded-0 border-2 border-dark p-2 btn-brutal-edit shadow-none btn-edit-magang" data-id="{{ $item->id }}" title="Edit Data">
                                    <i class="bi bi-pencil-square d-flex"></i>
                                </button>
                                <form action="{{ route('admin.magang.destroy', $item->id) }}" method="POST" class="form-delete-magang">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger rounded-0 border-2 border-dark p-2 btn-brutal-delete shadow-none btn-trigger-delete" title="Hapus Data">
                                        <i class="bi bi-trash3-fill d-flex"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted fw-bold">
                            <i class="bi bi-folder-x display-5 d-block mb-2 text-dark"></i>
                            <span class="text-uppercase tracking-wider">Belum ada rekaman data lowongan magang.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4 brutal-pagination">
        {{ $magangs->links('pagination::bootstrap-5') }}
    </div>

</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahMagang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-brutal border-4 border-dark rounded-0 p-3" style="box-shadow: 10px 10px 0px var(--shadow-color);">
            <div class="modal-header border-bottom border-3 border-dark rounded-0 px-0 pt-0 pb-3">
                <h4 class="modal-title fw-black text-uppercase text-dark m-0"><strong><i class="bi bi-plus-square-fill text-warning me-2"></i>Tambah Info Magang</strong></h4>
                <button type="button" class="btn-close shadow-none border-2 border-dark bg-light p-2 rounded-0 opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.magang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-0 py-4 row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_perusahaan" class="form-control brutal-input" placeholder="Contoh: PT. Telkom Indonesia" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Posisi Lowongan <span class="text-danger">*</span></label>
                        <input type="text" name="posisi_magang" class="form-control brutal-input" placeholder="Contoh: Fullstack Web Developer" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Lokasi Kantor <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" class="form-control brutal-input" placeholder="Contoh: Jakarta Pusat (Hybrid)" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-uppercase fw-black small text-dark">Durasi (Bulan) <span class="text-danger">*</span></label>
                        <input type="number" name="durasi_magang" class="form-control brutal-input" placeholder="6" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-uppercase fw-black small text-dark">Status Hubungan <span class="text-danger">*</span></label>
                        <select name="status_mitra" class="form-select brutal-input text-uppercase fw-bold" required>
                            <option value="mitra">Mitra BEM</option>
                            <option value="non-mitra">Umum (Non-Mitra)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Pilih Kategori Terbuka untuk Prodi <span class="text-danger">* (Minimal 1)</span></label>
                        <div class="p-3 border-3 border-dark prodi-container d-flex flex-wrap gap-3">
                            @foreach($list_prodi as $prodi)
                                <div class="form-check">
                                    <input class="form-check-input border-2 border-dark" type="checkbox" name="prodi_ids[]" value="{{ $prodi->id }}" id="prodi_tambah_{{ $prodi->id }}">
                                    <label class="form-check-label fw-bold text-dark" for="prodi_tambah_{{ $prodi->id }}">{{ $prodi->nama_prodi }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Link Pendaftaran Online</label>
                        <input type="url" name="link_pendaftaran" class="form-control brutal-input" placeholder="https://recruitment.company.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Tenggat Batas Penutupan</label>
                        <input type="date" name="tenggat_pendaftaran" class="form-control brutal-input">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control brutal-input" rows="3" placeholder="Tulis rincian deskripsi kerja job magang..." required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Kualifikasi / Persyaratan Alur <span class="text-danger">*</span></label>
                        <textarea name="kualifikasi" class="form-control brutal-input" rows="3" placeholder="Tulis kualifikasi pelamar atau alur pendaftaran berkas..." required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Upload Logo Perusahaan <span class="text-muted">(Format PNG/JPG/WebP, Max 2MB)</span></label>
                        <input type="file" name="logo" class="form-control brutal-input bg-white">
                    </div>
                </div>
                <div class="modal-footer border-top border-3 border-dark rounded-0 px-0 pb-0 pt-3 justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-0 border-3 border-dark text-uppercase fw-black px-4 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-0 border-3 border-dark text-uppercase text-white fw-black px-4 py-2 btn-brutal-save">Terbitkan Lowongan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditMagang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-brutal border-4 border-dark rounded-0 p-3" style="box-shadow: 10px 10px 0px var(--shadow-color);">
            <div class="modal-header border-bottom border-3 border-dark rounded-0 px-0 pt-0 pb-3">
                <h4 class="modal-title fw-black text-uppercase text-dark m-0"><strong><i class="bi bi-pencil-square text-warning me-2"></i>Perbarui Info Magang</strong></h4>
                <button type="button" class="btn-close shadow-none border-2 border-dark bg-light p-2 rounded-0 opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditMagang" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body px-0 py-4 row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_perusahaan" id="edit_nama_perusahaan" class="form-control brutal-input" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Posisi Lowongan <span class="text-danger">*</span></label>
                        <input type="text" name="posisi_magang" id="edit_posisi_magang" class="form-control brutal-input" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Lokasi Kantor <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" id="edit_lokasi" class="form-control brutal-input" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-uppercase fw-black small text-dark">Durasi (Bulan) <span class="text-danger">*</span></label>
                        <input type="number" name="durasi_magang" id="edit_durasi_magang" class="form-control brutal-input" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-uppercase fw-black small text-dark">Status Hubungan <span class="text-danger">*</span></label>
                        <select name="status_mitra" id="edit_status_mitra" class="form-select brutal-input text-uppercase fw-bold" required>
                            <option value="mitra">Mitra BEM</option>
                            <option value="non-mitra">Umum (Non-Mitra)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Pilih Kategori Terbuka untuk Prodi <span class="text-danger">*</span></label>
                        <div class="p-3 border-3 border-dark prodi-container d-flex flex-wrap gap-3">
                            @foreach($list_prodi as $prodi)
                                <div class="form-check">
                                    <input class="form-check-input border-2 border-dark checkbox-prodi-edit" type="checkbox" name="prodi_ids[]" value="{{ $prodi->id }}" id="prodi_edit_{{ $prodi->id }}">
                                    <label class="form-check-label fw-bold text-dark" for="prodi_edit_{{ $prodi->id }}">{{ $prodi->nama_prodi }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Link Pendaftaran Online</label>
                        <input type="url" name="link_pendaftaran" id="edit_link_pendaftaran" class="form-control brutal-input">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-black small text-dark">Tenggat Batas Penutupan</label>
                        <input type="date" name="tenggat_pendaftaran" id="edit_tenggat_pendaftaran" class="form-control brutal-input">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control brutal-input" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Kualifikasi / Persyaratan Alur <span class="text-danger">*</span></label>
                        <textarea name="kualifikasi" id="edit_kualifikasi" class="form-control brutal-input" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase fw-black small text-dark">Ganti Logo Perusahaan <span class="text-muted">(Biarkan kosong jika tidak ingin diubah)</span></label>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div id="container_old_logo"></div>
                            <input type="file" name="logo" class="form-control brutal-input bg-white w-100">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-3 border-dark rounded-0 px-0 pb-0 pt-3 justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-0 border-3 border-dark text-uppercase fw-black px-4 py-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning rounded-0 border-3 border-dark text-uppercase fw-black px-4 py-2 btn-brutal-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

    :root {
        --card-bg: #ffffff;
        --text-color: #101820;
        --table-bg: #ffffff;
        --input-bg: #ffffff;
        --shadow-color: #101820;
    }

    [data-theme="dark"] {
        --card-bg: #1e293b;
        --text-color: #f8fafc;
        --table-bg: #0f172a;
        --input-bg: #334155;
        --shadow-color: #000000;
    }

    .page-header{
        background:#ffc107;
        color:#101820;
    }

    [data-theme="dark"] .page-header{
        background:#f59e0b;
        color:#fff;
    }

    .table-wrapper{
        background:var(--table-bg);
        color:var(--text-color);
    }

    .brutal-input{
        border:3px solid #101820 !important;
        border-radius:0 !important;
        font-weight:700 !important;
        color:var(--text-color) !important;
        background:var(--input-bg) !important;
    }

    .modal-brutal{
        background:var(--card-bg);
        color:var(--text-color);
    }

    [data-theme="dark"] .form-label{
        color:#f8fafc !important;
    }

    .prodi-badge{
        background:#fff;
        color:#101820;
    }

    [data-theme="dark"] .prodi-badge{
        background:#334155;
        color:#fff;
    }

    [data-theme="dark"] tbody tr{
        background:#1e293b;
        color:#fff;
    }

    [data-theme="dark"] tbody tr:hover{
        background:#334155;
    }

    [data-theme="dark"] .page-link{
        background:#1e293b !important;
        color:#fff !important;
    }

    [data-theme="dark"] .page-item.active .page-link{
        background:#f59e0b !important;
        color:#000 !important;
    }

    [data-theme="dark"] .swal2-popup{
        background:#1e293b !important;
        color:#fff !important;
    }

    .prodi-container{
        background:#f8f9fa;
    }

    [data-theme="dark"] .prodi-container{
        background:#1e293b;
    }

    [data-theme="dark"] .form-check-label{
        color:#fff !important;
    }

    [data-theme="dark"] .swal2-success-ring{
        border-color:#22c55e !important;
    }

    [data-theme="dark"] .swal2-success-line-tip,
    [data-theme="dark"] .swal2-success-line-long{
        background-color:#22c55e !important;
    }

    [data-theme="dark"] .swal2-icon.swal2-success{
        border-color:#22c55e !important;
    }

    [data-theme="dark"] .table{
        color:#fff !important;
    }

    [data-theme="dark"] .table td,
    [data-theme="dark"] .table th{
        background:#1e293b !important;
        color:#fff !important;
    }

    [data-theme="dark"] .table-hover tbody tr:hover td{
        background:#334155 !important;
    }

    [data-theme="dark"] .modal-content{
        background:#1e293b !important;
        color:#fff !important;
    }

    [data-theme="dark"] .modal-header,
    [data-theme="dark"] .modal-footer{
        border-color:#475569 !important;
    }

    /* Styling CSS Brutalism */
    .fw-black { font-weight: 900 !important; }
    .btn-brutal-white:hover { background-color: #101820 !important; color: #fff !important; transform: translate(-2px, -2px); box-shadow: 4px 4px 0px var(--bs-warning) !important; }
    .btn-brutal-dark:hover { background-color: var(--bs-warning) !important; color: #101820 !important; transform: translate(-2px, -2px); box-shadow: 4px 4px 0px #101820 !important; }
    .btn-brutal-edit:hover { background-color: #101820 !important; color: var(--bs-warning) !important; transform: translate(-1px, -1px); box-shadow: 2px 2px 0px #101820 !important; }
    .btn-brutal-delete:hover { background-color: #101820 !important; color: var(--bs-danger) !important; transform: translate(-1px, -1px); box-shadow: 2px 2px 0px #101820 !important; }
    .btn-brutal-save:hover { transform: translate(-2px, -2px); box-shadow: 4px 4px 0px #101820 !important; }
    .brutal-pagination .page-item .page-link { border: 2px solid #101820 !important; border-radius: 0px !important; color: #101820 !important; font-weight: 800 !important; box-shadow: 2px 2px 0px #101820; margin: 0 3px; }
    .brutal-pagination .page-item.active .page-link { background-color: var(--bs-warning) !important; border-color: #101820 !important; color: #101820 !important; }
    .brutal-swal-popup { border: 4px solid #101820 !important; border-radius: 0px !important; box-shadow: 8px 8px 0px #101820 !important; }
    .brutal-swal-confirm-delete { border: 3px solid #101820 !important; border-radius: 0px !important; font-weight: 800 !important; text-transform: uppercase !important; background-color: #dc3545 !important; color: white !important; box-shadow: 3px 3px 0px #101820 !important; }
    .brutal-swal-cancel { border: 3px solid #101820 !important; border-radius: 0px !important; font-weight: 800 !important; text-transform: uppercase !important; background-color: #f8f9fa !important; color: #101820 !important; box-shadow: 3px 3px 0px #101820 !important; }
    .brutal-swal-confirm { border: 3px solid #101820 !important; border-radius: 0px !important; font-weight: 800 !important; text-transform: uppercase !important; background-color: #28a745 !important; color: white !important; box-shadow: 3px 3px 0px #101820 !important; }
</style>

<script>
const magangRoutes = {
    edit: @json(route('admin.magang.edit', ['id' => 0])).replace('/0/edit', ''),
    update: @json(route('admin.magang.update', ['id' => 0])).replace('/0', ''),
    storage: @json(asset('storage')),
};

document.addEventListener("DOMContentLoaded", function () {
    // 1. Delete Confirmation
    document.querySelectorAll('.btn-trigger-delete').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-delete-magang');
            Swal.fire({
                title: 'APAKAH KAMU YAKIN, EGE?',
                text: "Data lowongan magang ini bakal didelete permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'IYA, HAPUS!',
                cancelButtonText: 'BATALIN AJA',
                customClass: { popup: 'brutal-swal-popup', confirmButton: 'brutal-swal-confirm-delete', cancelButton: 'brutal-swal-cancel' },
                buttonsStyling: false
            }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });

    // 2. Success Notification
    @if(session('swal_success'))
        Swal.fire({
            title: 'MANTAP BERHASIL!',
            text: "{{ session('swal_success') }}",
            icon: 'success',
            confirmButtonText: 'OKE SIAP',
            customClass: { popup: 'brutal-swal-popup', confirmButton: 'brutal-swal-confirm' },
            buttonsStyling: false
        });
    @endif

    // 3. Edit Ajax Fetch
    document.querySelectorAll('.btn-edit-magang').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            fetch(`${magangRoutes.edit}/${id}/edit`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data.');
                    return response.json();
                })
                .then(res => {
                    if (res.status === 'success') {
                        const m = res.data;
                        document.getElementById('edit_nama_perusahaan').value = m.nama_perusahaan;
                        document.getElementById('edit_posisi_magang').value = m.posisi_magang;
                        document.getElementById('edit_lokasi').value = m.lokasi;
                        document.getElementById('edit_durasi_magang').value = m.durasi_magang;
                        document.getElementById('edit_status_mitra').value = m.status_mitra;
                        document.getElementById('edit_link_pendaftaran').value = m.link_pendaftaran || '';
                        document.getElementById('edit_tenggat_pendaftaran').value = m.tenggat_pendaftaran ? m.tenggat_pendaftaran.substring(0, 10) : '';
                        document.getElementById('edit_deskripsi').value = m.deskripsi;
                        document.getElementById('edit_kualifikasi').value = m.kualifikasi;
                        document.getElementById('formEditMagang').setAttribute('action', `${magangRoutes.update}/${id}`);
                        document.querySelectorAll('.checkbox-prodi-edit').forEach(ch => {
                            ch.checked = res.prodis.includes(parseInt(ch.value));
                        });
                        const container = document.getElementById('container_old_logo');
                        container.replaceChildren();
                        if (m.logo) {
                            const img = document.createElement('img');
                            img.src = `${magangRoutes.storage}/${m.logo}`;
                            img.alt = 'Logo lama';
                            img.className = 'border border-2 border-dark p-1';
                            img.style.cssText = 'width:50px; height:50px; object-fit:contain;';
                            container.appendChild(img);
                        }
                        new bootstrap.Modal(document.getElementById('modalEditMagang')).show();
                    }
                })
                .catch(() => {
                    Swal.fire({
                        title: 'GAGAL MEMUAT DATA',
                        text: 'Tidak dapat mengambil data lowongan. Coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OKE',
                        customClass: { popup: 'brutal-swal-popup', confirmButton: 'brutal-swal-confirm' },
                        buttonsStyling: false
                    });
                });
        });
    });
});
</script>
@endsection