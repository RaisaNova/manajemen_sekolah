<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Auth;
use Hash;
use Str;    


class StudentController extends Controller
{
    public function student_list()
    {
       
        $data['getRecord'] = User::getStudent(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Student";
        return view('backend.student.list', $data);
    }

    public function getclass(Request $request)
    {
        $getClass = ClassModel::getRecordActive($request->school_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($getClass as $class) {
            $html .= '<option value="'.$class->id.'">'.$class->name.'</option>';
        }
        return response()->json(['success' => $html]);
    }

    public function create_student()
    {

        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSchool'] = User::getSchoolAll();
        $data['meta_title'] = "Create Student";
        return view('backend.student.create', $data);
    }

    public function insert_student(Request $request)
    {
        
        request()->validate([   
            'email' => 'required|email|unique:users',
        ]);
        $user                        = new User;
        $user->name                  = trim ($request->name);    
        $user->last_name             = trim ($request->last_name);       
        $user->admission_number                = trim ($request->admission_number);       
        $user->roll_number         = trim ($request->roll_number);       
        $user->class_id       = trim ($request->class_id);       
        $user->gender         = trim ($request->gender);       
        $user->marital_status        = trim ($request->marital_status);       
        $user->date_of_birth               = trim ($request->date_of_birth);       
        $user->caste         = trim ($request->caste);       
        $user->religion        = trim ($request->religion);       
        $user->mobile_number     = trim ($request->mobile_number);       
        $user->admission_date                  = trim ($request->admission_date); 
        $user->blood_group                 = trim ($request->blood_group); 
        $user->address                 = trim ($request->address); 
        $user->permanent_address                 = trim ($request->permanent_address); 
        $user->email                 = trim ($request->email); 
        $user->password              = Hash::make($request->password); 
        $user->status                = trim ($request->status); 
        $user->is_admin = 6;
        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
        {
            $user->created_by_id = $request->school_id;
        }
        else
        {
            $user->created_by_id = Auth::user()->id;
        }
        $user->save();

        if (!empty($request->file('profile_pic')))
         {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
        
            $file->move('upload/profile/', $filename);
        
            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/student')->with('success', "Student successfully created");
    }
    public function edit_student($id)
    {
        $getRecord = User::getSignle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModel::getRecordActive($getRecord->created_by_id);
        $data['meta_title'] = "Edit Student";
        return view('backend.student.edit', $data);
    }

    public function update_student($id, Request $request)
    {
        request()->validate([   
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
    
        
        $user = User::getSignle($id);
        $user->name                  = trim ($request->name);    
        $user->last_name             = trim ($request->last_name);       
        $user->admission_number                = trim ($request->admission_number);       
        $user->roll_number         = trim ($request->roll_number);       
        $user->class_id       = trim ($request->class_id);       
        $user->gender         = trim ($request->gender);       
        $user->marital_status        = trim ($request->marital_status);       
        $user->date_of_birth               = trim ($request->date_of_birth);       
        $user->caste         = trim ($request->caste);       
        $user->religion        = trim ($request->religion);       
        $user->mobile_number     = trim ($request->mobile_number);       
        $user->admission_date                  = trim ($request->admission_date); 
        $user->blood_group                 = trim ($request->blood_group); 
        $user->address                 = trim ($request->address); 
        $user->permanent_address                 = trim ($request->permanent_address); 
        $user->email                 = trim ($request->email); 
        if (!empty($request->password)) 
        {
            $user->password = Hash::make($request->password); 
        }
        $user->status                = trim ($request->status); 
     
        $user->save();
    
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $user->profile_pic = $filename;
            $user->save();
        }
    
        return redirect('panel/student')->with('success', "Student successfully updated");
    }
    public function delete_student($id)
    {
        $user = User::getSignle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', "Teacher successfully deleted");
    }
}