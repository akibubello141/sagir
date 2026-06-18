<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    //
     //staff page
        public function Staff()
        {
            $staff = staff::all();

            return view('manager.staff', compact('staff'));
        }
     //save staff
        public function save(Request $request)
        {
            Staff::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return back()->with('success', 'Staff added');
        }

        //edit staff    
        public function edit($id)
        {
            $staff = Staff::findOrFail($id);

            return view('manager.edit_staff', compact('staff'));
        }

        //update staff
        public function update(Request $request, $id)
        {
            $staff = Staff::findOrFail($id);
            $staff->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return redirect()->route('manager.staff.index')->with('success', 'Staff updated');
        }

        //delete staff
        public function delete($id)
        {
            $staff = Staff::findOrFail($id);
            $staff->delete();

            return redirect()->route('manager.staff.index')->with('success', 'Staff deleted');
        }
}
