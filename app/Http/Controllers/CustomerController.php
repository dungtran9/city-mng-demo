<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Http\Requests\FormCustomerCreateRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $cities = City::all();
        return view('customer.list', compact('customers', 'cities'));
    }

    public function create()
    {
        $cities = City::all();
        return view('customer.create', compact('cities'));
    }

    public function store(FormCustomerCreateRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();
        toastr()->success('Tạo mới khách hàng thành công', 'Chúc mừng bạn');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities = City::all();

        return view('customer.edit', compact('customer', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();
        toastr()->success('Cập nhật khách hàng thành công', 'Chúc mừng bạn');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        toastr()->success('Xóa khách hàng thành công', 'Chúc mừng bạn');
        return redirect()->route('customers.index');
    }

    public function filterByCity(Request $request)
    {
        $idCity = $request->input('city_id');
        $cityFilter = City::findOrFail($idCity);
        $customers = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customer.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    public function search(Request $request)
    {
        $keyword = $request->key;
        if (!$keyword) {
            return redirect()->route('customers.index');
        }
        $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
        $cities = City::all();
        return view('customer.search', compact('customers', 'cities'));
    }
}
