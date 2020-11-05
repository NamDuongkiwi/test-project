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
        //return $request->;
    }

    public function enroll(Request $request){
        $token = $request->bearerToken();

        $user = $request->user();
        //$id = User::where('api_token', $token);
        $id = Auth::guard('api')->id();
        //$token = Auth::user()->
        \DB::table('student_class')
            ->insert([ 'student_id'=> $id, 'class_id' => request('class_id')]
        );
    }
}

