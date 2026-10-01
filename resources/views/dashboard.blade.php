@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-4">Ringkasan Sistem</h4>

<!-- Kartu Statistik (5 Modul Utama) -->
<div class="row g-3 mb-4">
    <!-- Users -->
    <div class="col">
        <div class="card border-0 shadow-sm border-start border-primary border-4 py-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-uppercase text-muted fw-bold small">Pengguna (Users)</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalUsers }}</div>
                </div>
                <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                    <i class="bi bi-people-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Students -->
    <div class="col">
        <div class="card border-0 shadow-sm border-start border-info border-4 py-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-uppercase text-muted fw-bold small">Siswa (Students)</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalStudents }}</div>
                </div>
                <div class="bg-info-subtle text-info p-3 rounded-circle">
                    <i class="bi bi-mortarboard-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="col">
        <div class="card border-0 shadow-sm border-start border-success border-4 py-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-uppercase text-muted fw-bold small">Guru (Teachers)</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalTeachers }}</div>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-circle">
                    <i class="bi bi-person-badge-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes -->
    <div class="col">
        <div class="card border-0 shadow-sm border-start border-warning border-4 py-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-uppercase text-muted fw-bold small">Kelas (Classes)</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalClasses }}</div>
                </div>
                <div class="bg-warning-subtle text-warning p-3 rounded-circle">
                    <i class="bi bi-bank-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects -->
    <div class="col">
        <div class="card border-0 shadow-sm border-start border-danger border-4 py-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-uppercase text-muted fw-bold small">Mapel (Subjects)</div>
                    <div class="h3 mb-0 fw-bold">{{ $totalSubjects }}</div>
                </div>
                <div class="bg-danger-subtle text-danger p-3 rounded-circle">
                    <i class="bi bi-book-fill fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Siswa Terbaru -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Data Siswa Terbaru</h6>
        <a href="{{ route('students.index') }}" class="text-decoration-none small">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase text-muted small">
                <tr>
                    <th class="ps-3">ID / NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentStudents as $student)
                <tr>
                    <td class="ps-3 text-secondary">{{ $student->nis }}</td>
                    <td class="fw-bold">{{ $student->full_name }}</td>
                    <td>{{ $student->class->class_name ?? 'Belum Ada Kelas' }}</td>
                    <td>
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Aktif</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada data siswa terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
