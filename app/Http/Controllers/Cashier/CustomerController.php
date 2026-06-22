<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //driver
        public function show()
        {
            $customer = Customer::all();

            return view(
                'cashier.customers',
                compact('customer')
            );
        }

        public function store(Request $request)
        {
            Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'vehicle_number' => $request->vehicle_number,
                'address' => $request->address,
            ]);

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Driver added successfully.'
                );
        }

        //edit driver
        public function edit($id)
        {
            $customer = Customer::findOrFail($id);

            return view(
                'cashier.edit-customer',
                compact('customer')
            );
        }

        //update driver
        public function update(Request $request, $id)
        {
            $customer = Customer::findOrFail($id);

            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'vehicle_number' => $request->vehicle_number,
                'address' => $request->address,
            ]);



           $customer = Customer::all();

            return view(
                'cashier.customers',
                compact('customer')
            );
        }

        //delete driver
        public function delete($id)
        {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Driver deleted successfully.'
                );
                
                }
}