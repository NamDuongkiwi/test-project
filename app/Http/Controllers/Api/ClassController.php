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
        $id = $request->header();
        return $id;
    }

    public function enroll(Request $request){
        /*$token = $request->bearerToken();
        $id = \DB::table('users')->select('id')->where('api_token', '=',$token)->get('id');
        $user = $request->user();
        $id = json_encode($id);
        $id = substr($id,7,8);*/
        $user_id = $request->header('id');
        //$token = Auth::user()->
        \DB::table('student_class')
            ->insert([ 'student_id'=> $user_id, 'class_id' => request('class_id')]
        );
    }
    public function show(Request $request){
        $user_id = $request->header('id');
        $detais = \DB::table('student_class')
            ->join('class', 'class.class_id', 'student_class.class_id')
            ->join('subject', 'class.subject_id', 'subject.subject_id')
            ->select('class.class_id', 'subject.subject_name', 'class.max_student',
                'class.room', 'class.day','class.start_class','class.end_class')
            ->where('student_class.student_id', '=', $user_id)
            ->get();
        return $detais;
    }

}

