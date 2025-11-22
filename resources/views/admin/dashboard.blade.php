@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Dashboard Admin</h1>

        <div class="alert alert-success">
            Selamat datang, Admin! Anda berhasil login ke halaman dashboard.
        </div>

        <div class="row">
            <!-- Card example -->
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text fs-3">120</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-success mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total User</h5>
                        <p class="card-text fs-3">58</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-warning mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Permintaan Baru</h5>
                        <p class="card-text fs-3">10</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel contoh -->
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <strong>Log Aktivitas Terbaru</strong>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Menambahkan produk baru</td>
                            <td>10 Menit Lalu</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Login ke dashboard</td>
                            <td>15 Menit Lalu</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mengupdate profile</td>
                            <td>1 Jam Lalu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
