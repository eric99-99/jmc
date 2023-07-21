<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('province')->get()->sortBy('id');
        return view('master.city.index', ['cities' => $cities ]);
    }

    public function create()
    {
        return view('master.city.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'code' => 'required|max:10',
            'name' => 'required|max:100',
            'total_population' => 'required|numeric|min:1',
        ];

        $validatedData = $request->validate($rule);

        if( $request['province']){
            $validatedData['province_id'] = $request['province'];
        }

        $process = DB::transaction( function() use($validatedData){
            try {
                City::create($validatedData);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        if($process){
            return redirect('/city')->with('success', 'Data berhasil disimpan');
        } else{
            return redirect()->back()->with('failed', 'Data gagal disimpan, silakan ulangi lagi');
        }

    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('master.city.edit', ['city' => $city]);
    }

    public function update(Request $request, $id)
    {
        $rule = [
            'code' => 'required|max:10',
            'name' => 'required|max:100',
            'total_population' => 'required|numeric|min:1',
        ];

        $validatedData = $request->validate($rule);

        if( $request['province']){
            $validatedData['province_id'] = $request['province'];
        }

        $process = DB::Transaction(function() use($validatedData, $id){
            try {
                City::where('id', $id)->update($validatedData);
                return true;
            } catch (\Exception $e) {
                dd($e);
                return false;
            }
        });

        if ($process) {
            return redirect()->route('city.index')->with('success', 'Data berhasil diubah');
        } else{
            return redirect()->back()->with('failed', 'Data gagal diubah, silakan ulangi lagi');
        }
    }

    public function destroy($id)
    {

        $process = DB::Transaction(function() use($id){
            try {
                City::where('id', $id)->delete();
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        if ($process) {
            return redirect()->route('city.index')->with('success', 'Data berhasil dihapus');
        } else{
            return redirect()->route('city.index')->with('failed', 'Data gagal dihapus, silakan ulangi lagi');
        }
    }

    public function reportPopulation()
    {
        $provinces = Province::all();

        $population = Province::join('cities','cities.province_id', 'provinces.id')
                      ->select('cities.*', 'provinces.name as province_name');

        if(request('province')){
            $population = $population->where('province_id', request('province'));
        }


        $population = $population->get() ;

        return view('report.city', ['population' => $population, 'provinces' => $provinces  ]);
    }
}
