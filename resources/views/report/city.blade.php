@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2">
        <h5>Laporan Jumlah Penduduk Per Kabupaten/Kota</h5>
    </div>
    <form class="row gx-3 gy-2 align-items-center mb-2"  action="{{ route('report.city') }}">
        <div class="col-sm-5">
        <label class="visually-hidden" for="province">Provinsi</label>
        <select class="form-select" id="province" name="province">
          <option selected value="">Provinsi</option>
          @foreach ($provinces as $province)
              <option value="{{ $province->id }}" {{ request('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
          @endforeach
        </select>
      </div>

       <div class="col-auto">
         <button type="submit" class="btn btn-success"> <span data-feather="search"></span> Cari Data</button>
         {{-- <a href="{{ route('report.city') }}" class="btn btn-secondary mr-sm-2">  <span data-feather="search"></span> Semua</a> --}}
       </div>
     </form>

    <div class="table-responsive">
        <table class="table table-bordered border-success table-sm">
          <thead>
            <tr class="text-center bg-secondary text-light">
              <th scope="col">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Kabupaten</th>
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
                    <td>{{ $city['province_name'] }}</td>
                    <td>{{ $city['total_population'] }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>

@endsection