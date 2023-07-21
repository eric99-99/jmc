@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2">
        <h5>Laporan Jumlah Penduduk Per Provinsi</h5>
        </div>
    <div class="table-responsive">
        <table class="table table-bordered border-success table-sm">
          <thead>
            <tr class="text-center bg-secondary text-light">
              <th scope="col">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Provinsi</th>
              <th scope="col">Jml.Penduduk</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($population as $city)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td>{{ $city['code'] }}</td>
                    <td>{{ $city['name'] }}</td>
                    <td>{{ $city['total'] }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>

@endsection