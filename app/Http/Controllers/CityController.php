<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }
    public function create(){
        return view('cities.create');
    }
    public function store(Request $request){
        $city = new City();
        $city->name     = $request->name;
        $city->save();
        toastr()->success('Thêm mới tỉnh thành công', 'Chúc mừng bạn');
        return redirect()->route('cities.index');
    }
    public function delete($id){
        $city = City::findOrFail($id);
        $city->customers()->delete();
        $city->delete();
        toastr()->success('Xóa tỉnh thành công', 'Chúc mừng bạn');
        return redirect()->route('cities.index');
    }
    public function edit($id){
        $city = City::findOrFail($id);
        return view('cities.edit',compact('city'));
    }
    public function update(Request $request,$id){
        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->save();
        toastr()->success('Cập nhật tỉnh thành công', 'Chúc mừng bạn');
        return redirect()->route('cities.index');
    }
}
