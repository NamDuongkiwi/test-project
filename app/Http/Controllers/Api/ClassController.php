<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function getpage($page){
        $class = \DB::table('class')
            ->join('teacher', 'teacher.teacher_id', '=', 'class.teacher_id')
            ->join('subject', 'subject.subject_id', '=','class.subject_id' )
            ->select('class.class_id', 'subject.subject_name', 'class.max_student',
                'class.room', 'class.day','class.start_class','class.end_class', 'teacher.name as teacher_name')
            ->offset(($page-1)*10)
            ->limit(10)
            ->get();
        return $class;
    }
    public function deleteclass(Request $request){
        $id = Auth::id();
        $data = \DB::table('student_class')
            /*->where(['student_id','class_id'], [$id, request('class_id')]);*/
            ->where('student_id', $id)
            ->where('class_id', request('class_id'));
        $data->delete();
    }

    /*
        Phương thức đăng ký học
    */
    public function enroll(Request $request){ 
        
        $user_id = Auth::id();
        $class_id = $request->get('class_id');

        $new_class = \DB::table('class')
            ->select('class_id', 'subject_id', 'day', 'start_class', 'end_class')
            ->where('class_id', '=', $class_id)
            ->get();
        $new_class = json_decode($new_class, true);
        $subject = $new_class[0]["subject_id"];
        

        $data = \DB::table('student_class')
            ->join('class', 'class.class_id', 'student_class.class_id')
            ->join('subject', 'class.subject_id', 'subject.subject_id')
            ->select('class.class_id', 'class.max_student',
                'class.subject_id',
                'class.day','class.start_class','class.end_class')
            ->where('student_class.student_id', '=', $user_id)
            ->get();
        $class = json_decode($data, true);

        $k = 0;

        foreach($class as $value){
            if($subject == $value["subject_id"]){
                $k=1;
                break;  
            }else if($new_class[0]["day"] == $value["day"]){
                if($new_class[0]["start_class"] > $value["end_class"] ||  
                    $new_class[0]["end_class"] < $value["start_class"])
                    $k = 0;
                else{
                    $k = 2;
                    break;
                }
            }
        }
        //
        if($k == 1){
            return response()->json("Lớp học bạn chọn đang trùng với môn đã đăng ký", 500);
        }
        else if($k == 2){
            return response()->json("Lớp học này có trùng thời khoá biểu với lớp khác bạn đã đăng ký", 500);
        }
        else if($k == 0){
            \DB::table('student_class')
            ->insert([ 'student_id'=> $user_id, 'class_id' => request('class_id')]
            );
            return response()->json("Bạn đã đăng ký thành công", 200);
        }
        
    }



    public function show(Request $request){
        //$user_id = $request->header('id');
        $user_id = Auth::id();
        $detais = \DB::table('student_class')
            ->join('class', 'class.class_id', 'student_class.class_id')
            ->join('subject', 'class.subject_id', 'subject.subject_id')
            ->select('class.class_id', 'subject.subject_name', 'class.max_student',
                'class.room', 'class.day','class.start_class','class.end_class')
            ->where('student_class.student_id', '=', $user_id)
            ->get();
        return $detais;
    }
    public function test(Request $request){
        //return response()->json($request->user());
        $user_id = Auth::id();
        $class_id = $request->get('class_id');

        $new_class = \DB::table('class')
            ->select('class_id', 'subject_id', 'day', 'start_class', 'end_class')
            ->where('class_id', '=', $class_id)
            ->get();
        $new_class = json_decode($new_class, true);
        $subject = $new_class[0]["subject_id"];
        

        $data = \DB::table('student_class')
            ->join('class', 'class.class_id', 'student_class.class_id')
            ->join('subject', 'class.subject_id', 'subject.subject_id')
            ->select('class.class_id', 'class.max_student',
                'class.subject_id',
                'class.day','class.start_class','class.end_class')
            ->where('student_class.student_id', '=', $user_id)
            ->get();
        $class = json_decode($data, true);

        $k = 0;

        foreach($class as $value){
            if($subject == $value["subject_id"]){
                $k=1;
                break;  
            }else if($new_class[0]["day"] == $value["day"]){
                if($new_class[0]["start_class"] > $value["end_class"] ||  
                    $new_class[0]["end_class"] < $value["start_class"])
                    $k = 0;
                else{
                    $k = 2;
                    break;
                }
            }
        }
        //
        if($k == 1){
            return response()->json("Lớp học bạn chọn đang trùng với môn đã đăng ký", 400);
        }
        else if($k == 2){
            return response()->json("Lớp học này có trùng thời khoá biểu với lớp khác bạn đã đăng ký", 400);
        }
        else if($k == 0){
            return response()->json("Bạn đã đăng ký thành công", 200);
        }
    }
}

