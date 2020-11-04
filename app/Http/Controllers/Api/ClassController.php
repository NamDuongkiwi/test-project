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
    public function deleteclass(){
        $user_id = Auth::id();
        $id = request('id');
        $class = \DB::class('student_class') -> where($user_id, $id) ->get();
        $class -> delete();
    }

    public function enroll(){
        $user = Auth::user();
        $id = Auth::id();
        \DB::table('student_class')
            ->insert([ 'student_id'=> $id, 'class_id' => request('class_id')]
        );
    }
}

