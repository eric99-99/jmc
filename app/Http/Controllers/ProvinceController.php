<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all()->sortBy('id');
        return view('master.province.index', ['provinces' => $provinces ]);
    }

    public function create()
    {
        return view('master.province.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'code' => 'required|max:10',
            'name' => 'required|max:100',
        ];

        $validatedData = $request->validate($rule);

        $process = DB::transaction( function() use($validatedData){
            try {
                Province::create($validatedData);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        if($process){
            return redirect('/province')->with('success', 'Data berhasil disimpan');
        } else{
            return redirect()->back()->with('failed', 'Data gagal disimpan, silakan ulangi lagi');
        }

    }

    public function edit($id)
    {
        $province = Province::find($id);
        return view('master.province.edit', ['province' => $province]);
    }

    public function update(Request $request, $id)
    {
        $rule = [
            'code' => 'required|max:10',
            'name' => 'required|max:100',
        ];

        $validatedData = $request->validate($rule);

        $process = DB::Transaction(function() use($validatedData, $id){
            try {
                Province::where('id', $id)->update($validatedData);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        if ($process) {
            return redirect()->route('province.index')->with('success', 'Data berhasil diubah');
        } else{
            return redirect()->back()->with('failed', 'Data gagal diubah, silakan ulangi lagi');
        }
    }

    public function destroy($id)
    {

        $process = DB::Transaction(function() use($id){
            try {
                Province::where('id', $id)->delete();
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        if ($process) {
            return redirect()->route('province.index')->with('success', 'Data berhasil dihapus');
        } else{
            return redirect()->route('province.index')->with('failed', 'Data gagal dihapus, silakan ulangi lagi');
        }
    }

    public function apiProvince()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function reportPopulation()
    {
        $population = Province::join('cities','cities.province_id', 'provinces.id')
                      ->select('provinces.code', 'provinces.name', DB::RAW("SUM(cities.total_population) as total"))
                      ->groupBy('provinces.code')
                      ->groupBy('provinces.name')
                      ->get() ;
        return view('report.province', ['population' => $population ]);
    }

}
