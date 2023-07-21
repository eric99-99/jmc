@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2">
        <h5>Provinsi</h5>
        <a href="{{ route('province.create') }}" class="btn btn-success btn-sm">
            <span data-feather="plus-circle"></span> Tambah Data
        </a>
    </div>
    @if(session()->has('success'))
        <div class="container alert alert-success" role="alert">
            {{session('success') }}
        </div>
    @endif

    @if(session()->has('failed'))
        <div class="container alert alert-danger" role="alert">
            {{session('failed') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered border-success table-sm">
          <thead>
            <tr class="text-center bg-secondary text-light">
              <th scope="col">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama Provinsi</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($provinces as $province)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td>{{ $province['code'] }}</td>
                    <td>{{ $province['name'] }}</td>
                    <td class="text-center">
                        <a href="/province/{{$province->id}}/edit" class="badge bg-warning mb-1">
                          <span data-feather="edit"></span>
                        </a>

                        <form action="{{route('province.destroy', $province->id )}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger border border-0" onclick="return confirm('Apalkah yakin akan menghapus data ini ?')">
                            <span data-feather="x-circle"></span>
                        </button>
                        </form>

                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>

@endsection