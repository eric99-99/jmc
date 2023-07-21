@extends('layouts.main')

@section('content')
    @if(session()->has('failed'))
        <div class="container alert alert-danger" role="alert">
            {{session('failed') }}
        </div>
    @endif

    <form action="{{route('city.update', $city->id)}}" method="post">
        @method('PUT')
        @csrf

        <div class="card text-center mt-2">
            <div class="card-header">
            <h6> Ubah Data - Kabupaten/Kota </h6>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="code" name="code" required
                        value="{{ $city->code ?? old('code')}}" placeholder="Kode">
                    <label for="name">Kode</label>
                </div>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ $city->name ?? old('name')}}" placeholder="Nama Kabupaten/Kota">
                    <label for="name">Nama Kabupaten/Kota</label>
                </div>
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="total_population" name="total_population" required
                    value="{{ $city->total_population ?? old('total_population')}}" placeholder="Nama Jurusan">
                    <label for="total_population">Jumlah Penduduk</label>
                </div>
            </div>

            <div class="card-body">
                <div class="form-floating mb-3">
                    <select class="form-select" id="province" name="province">
                        <option selected></option>
                    </select>
                    <label for="province">Provinsi</label>
                </div>
            </div>

            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success" id="btnSubmit">
                    <span data-feather="edit"> </span> Ubah
                </button>
                <a href="/city" class="btn btn-warning">
                    <span data-feather="x-square"></span> Batal
                </a>

            </div>
        </div>
    </form>
    <script>
        const province = document.querySelector('#province');

        document.addEventListener('DOMContentLoaded',function(){
            getProvince(province);
        });

        function getProvince(oprovince){
            oprovince.required = false;
            fetch('/api/province')
                .then(response => response.json())
                .then(data => {
                    let arrProvince = data;
                    if(arrProvince.length > 0 ){
                        let oldValue;
                        oprovince.required = true;
                        switch (oprovince.name) {
                            case 'province':
                                    oldValue = "{{ $city['province_id']}}"
                                break;
                        }

                        for (let index = 0; index < arrProvince.length; index++) {
                            let option = document.createElement('option');
                            option.value = arrProvince[index].id
                            option.text = arrProvince[index].name;
                            oprovince.add(option);

                            if(option.value == oldValue ){
                                option.selected = true;
                            }
                        }
                    }
                })
                .catch(function (err) {
                    // There was an error
                    console.warn('Error.', err);
                });

        };

    </script>
@endsection