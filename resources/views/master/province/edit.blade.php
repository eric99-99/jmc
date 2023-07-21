@extends('layouts.main')

@section('content')
    @if(session()->has('failed'))
        <div class="container alert alert-danger" role="alert">
            {{session('failed') }}
        </div>
    @endif

    <form action="{{route('province.update', $province->id)}}" method="post">
        @method('PUT')
        @csrf

        <div class="card text-center mt-2">
            <div class="card-header">
            <h6> Ubah Data - Provinsi </h6>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="code" name="code" required
                        value="{{ $province->code ?? old('code')}}" placeholder="Kode">
                    <label for="name">Kode</label>
                </div>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ $province->name ?? old('name')}}" placeholder="Nama Provinsi">
                    <label for="name">Nama Provinsi</label>
                </div>
            </div>

            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success" id="btnSubmit">
                    <span data-feather="edit"> </span> Ubah
                </button>
                <a href="/province" class="btn btn-warning">
                    <span data-feather="x-square"></span> Batal
                </a>

            </div>
        </div>
    </form>
@endsection