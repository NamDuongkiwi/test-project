<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = \DB::table('class')
            ->join('teacher', 'teacher.teacher_id', '=', 'class.teacher_id')
            ->join('subject', 'subject.subject_id', '=','class.subject_id' )
            /*->leftJoin('student_class', 'student_class.class_id' , '=', 'class.class_id')*/
            ->select('class.class_id', 'subject.subject_name', 'class.max_student',
                /*(\DB::raw('count(student_class.student_id) as current_student')),*/
                'class.room', 'class.day','class.start_class','class.end_class', 'teacher.name as teacher_name')
            /*->groupBy('student_class.class_id')*/
            ->get();
        return $class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
