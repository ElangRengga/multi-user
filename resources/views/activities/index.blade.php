@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Aktivitas Pengeluaran Barang</h1>
        <form method="GET" action="{{ route('activities.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari barang...">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('activities.checkout') }}">
            @csrf
            <div class="mb-3">
                <label for="item_id" class="form-label">Pilih Barang</label>
                <select name="item_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->quantity }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>
            <button type="submit" class="btn btn-primary">Keluarkan Barang</button>
            <div class="mt-4">
                <a href="{{ route('activities.history') }}" class="btn btn-secondary">Lihat Riwayat Pengeluaran</a>
            </div>
        </form>

        <h2 class="mt-5">Daftar Stok Barang</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
