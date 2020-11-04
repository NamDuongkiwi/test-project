<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller{
    public function importDataset(Request $request){
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $col = fgetcsv($file);
            while(!feof($file)){
                $rowData[]=fgetcsv($file);
            }
            foreach ($rowData as $key => $value){
                \DB::table('class')
                    ->insert(['class_id' => $value[0],
                        'subject_id' => $value[1],
                        'room' => $value[2],
                        'day' => $value[3],
                        'start_class' => $value[4],
                        'end_class' => $value[5],
                        'teacher_id' => $value[6],
                        'max_student' => $value[7],
                    ]);

            }
        }
        else{
            return 'No file has found';
        }
        return 'Success';
    }
}
