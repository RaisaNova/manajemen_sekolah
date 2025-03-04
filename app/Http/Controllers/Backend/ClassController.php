<?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\ClassModel;  
    use App\Models\SubjectModel;
    use App\Models\ClassTeacherModel;
    use App\Models\ClassTimetableModel;
    use App\Models\WeekModel;
    use App\Models\User;
    use Auth;
    use Hash;
    use Str;


    class ClassController extends Controller
    {
        public function class_list()
        {
            $data['getRecord'] = ClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
            $data['meta_title'] = "Class";
            return view('backend.class.list', $data);
        }

        public function create_class()
        {
            $data['meta_title'] = "Create Class";
            return view('backend.class.create', $data);
        }
        public function insert_class(Request $request)
        {

            $save = new ClassModel;
            $save->name = trim ($request->name);             
            $save->status = trim ($request->status);         
            $save->created_by_id = Auth::user()->id;
            $save->save();

            return redirect('panel/class')->with('success', "Class successfully created");
        } 

        public function edit_class($id)
        {
            $data['getRecord'] = ClassModel::getSignle($id);
            if (!$data['getRecord']) {
                abort(404); 
            }
            $data['meta_title'] = "Edit Class";
            return view('backend.class.edit', $data);
        }

        public function update_class($id, Request $request)
        {
            $save = ClassModel::getSignle($id);
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->status = trim($request->status);
            $save->save();

            return redirect('panel/class')->with('success', "Class successfully updated"); // Corrected redirect
        }

        public function delete_class($id)
        {
            $save = ClassModel::getSignle($id);
            $save->is_delete = 1;
            $save->save();

            return redirect('panel/class')->with('success', "Class successfully deleted");
        }

        public function assign_class_teacher_list(Request $request)
        {
            $data['getRecord'] = ClassTeacherModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
            $data['meta_title'] = "Assign Class Teacher";
            return view('backend.assign_class_teacher.list', $data);
        }

        public function create_assign_class_teacher(Request $request)
        {
            $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
            $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
            $data['meta_title'] = "Create Assign Class Teacher";
            return view('backend.assign_class_teacher.create', $data);
        }

        public function insert_assign_class_teacher(Request $request)
        {
            if(!empty($request->class_id) && !empty($request->teacher_id))
            {
                foreach($request->teacher_id as $teacher_id)
                {
                    if(!empty($teacher_id))
                    {
                        $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                        if(empty($check))
                        {
                            $save = new ClassTeacherModel;
                            $save->class_id = trim ($request->class_id);             
                            $save->teacher_id = trim ($teacher_id);         
                            $save->status = trim ($request->status);         
                            $save->created_by_id = Auth::user()->id;
                            $save->save();
                        }
                    }
                }
            }
            return redirect('panel/assign-class-teacher')->with('success', "Assign Class Teacher Successfully Created "); 
        }

        public function edit_single_assign_class_teacher($id)
        {
            $data['getRecord'] = ClassTeacherModel::getSignle($id);
            $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
            $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);

            $data['meta_title'] = "Edit Assign Class Teacher";
            return view('backend.assign_class_teacher.edit_single', $data);
        }

        public function update_single_assign_class_teacher(Request $request, $teacher_id)
        {
            $check = ClassTeacherModel::checkClassTeacherSingle(Auth::user()->id, $request->class_id, $request->teacher_id);
            if(empty($check))
            {
                $save = new ClassTeacherModel;
                $save->class_id = trim ($request->class_id);             
                $save->teacher_id = trim ($request->$teacher_id);      
                $save->status = trim ($request->status);         
                $save->created_by_id = Auth::user()->id;
                $save->save();
            }
            else
            {
                $check->class_id = trim ($request->class_id);             
                $check->teacher_id = trim ($request->$teacher_id);
                $check->status = trim ($request->status);
                $check->save();

                return redirect('panel/assign-class-teacher')->with('success', "Assign Class Teacher Successfully Updated "); 
            }
        }

        public function edit_assign_class_teacher($id)
        {
            $getRecord = ClassTeacherModel::getSignle($id);
            $data['getRecord'] = $getRecord;

            $data['getSelectedTeacher'] = ClassTeacherModel::getSelectedTeacher($getRecord->class_id, Auth::user()->id);
            $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
            $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);

            $data['meta_title'] = "Edit Assign Class Teacher";
            return view('backend.assign_class_teacher.edit', $data);
        }

        public function update_assign_class_teacher($id, Request $request)
        {
            if(!empty($request->class_id))
            {

                ClassTeacherModel::deleteClassTeacher($request->class_id, Auth::user()->id);
                foreach((array) $request->teacher_id as $teacher_id)
                {
                    if(!empty($teacher_id))
                    {
                        $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);
                        if(empty($check))
                        {
                            $save = new ClassTeacherModel;
                            $save->class_id = trim ($request->class_id);             
                            $save->teacher_id = trim ($teacher_id);         
                            $save->status = trim ($request->status);         
                            $save->created_by_id = Auth::user()->id;
                            $save->save();
                        }
                    }
                }
            }
            return redirect('panel/assign-class-teacher')->with('success', "Assign Class Teacher Successfully Updated "); 
        }

        public function delete_assign_class_teacher($id)
        {
            $save = ClassTeacherModel::getSignle($id);
            $save->is_delete = 1;
            $save->save();

            return redirect('panel/assign-class-teacher')->with('success', "Assign Class Teacher Successfully Deleted");
        }

        public function TeacherClassSubject()
        {
            $data['getRecord'] = ClassTeacherModel::getRecordTeacher(Auth::user()->id);
            $data['meta_title'] = "My Class & Subject";
            return view('teacher.class_subject.list', $data);   
        }
        public function insertTimeTable(Request $request)
        {
            $save = new ClassTimetableModel;
            $save->start_time = $request->start_time;
            $save->end_time = $request->end_time;
            $save->room_number = $request->room_number;
            $save->save();

        }
    
        public function TeacherTimeTable($class_id, $subject_id)
        {
            $result = array();
            $getWeek = WeekModel::getRecord();
            
            foreach ($getWeek as $week) {
                $arraydata = array();
                $arraydata['id'] = $week->id;
                $arraydata['week_name'] = $week->name;
            
                $getClassTimeTable = ClassTimetableModel::getRecord($class_id, $subject_id, $week->id);
            
                if (!empty($getClassTimeTable)) {
                    dd($getClassTimeTable);

                    $arraydata['start_time'] = $getClassTimeTable->start_time;
                    $arraydata['end_time'] = $getClassTimeTable->end_time;
                    $arraydata['room_number'] = $getClassTimeTable->room_number;
                } else {
                    $arraydata['start_time'] = '';
                    $arraydata['end_time'] = '';
                    $arraydata['room_number'] = '';
                }
                $result[] = $arraydata;
            }

            $data['getRecord'] = $result;

            $data['getClass'] = ClassModel::getSignle($class_id);
            $data['getSubject'] = SubjectModel::getSignle($subject_id);

            $data['meta_title'] = "My Class & Subject Timetable";
            return view('teacher.class_subject.timetable', $data);

        }
    }

