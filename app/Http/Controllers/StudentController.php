<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class StudentController extends Controller
{
    public function create()
    {
        return view('createStudent');
    }

    public function fetch_data(Request $request)
    {
        $orderby = ($request->orderby != null ? $request->orderby : 'id');
        $theascdesc = ($request->theascdesc != null ? $request->theascdesc : 'ASC');
        $orderbys = [$orderby, $theascdesc];
        $likes = [
            $likeid = $request->likeid,
            $likefname = $request->likefname,
            $likelname = $request->likelname,
            $likesnumber = $request->likesnumber,
            $likedepartment = $request->likedepartment,
            $likeage = $request->likeage
        ];
        $students = DB::table('students')
            ->where('user_id', '=', auth()->user()->id)
            ->where('id', 'LIKE', '%' . $likeid . '%')
            ->where('fname', 'LIKE', '%' . $likefname . '%')
            ->where('lname', 'LIKE', '%' . $likelname . '%')
            ->where('snumber', 'LIKE', '%' . $likesnumber . '%')
            ->where('department', 'LIKE', '%' . $likedepartment . '%')
            ->where('age', 'LIKE', '%' . $likeage . '%')
            ->orderBy($orderby, $theascdesc)
            ->paginate(10);

        if ($request->ajax()) {
            return view('pagination', compact('students', 'likes', 'orderbys'))->render();
        } else {
            return "something wrong in function fetch_data ....";
        }
    }
    public function studentlist(Request $request)
    {
        $orderby = ($request->orderby != null ? $request->orderby : 'id');
        $theascdesc = ($request->theascdesc != null ? $request->theascdesc : 'ASC');
        $orderbys = [$orderby, $theascdesc];
        $likes = [$likeid = $request->likeid, $likefname = $request->likefname, $likelname = $request->likelname, $likesnumber = $request->likesnumber, $likedepartment = $request->likedepartment, $likeage = $request->likeage];
        $students = DB::table('students')
            ->where('user_id', '=', auth()->user()->id)
            ->where('id', 'LIKE', '%' . $likeid . '%')
            ->where('fname', 'LIKE', '%' . $likefname . '%')
            ->where('lname', 'LIKE', '%' . $likelname . '%')
            ->where('snumber', 'LIKE', '%' . $likesnumber . '%')
            ->where('department', 'LIKE', '%' . $likedepartment . '%')
            ->where('age', 'LIKE', '%' . $likeage . '%')
            ->orderBy($orderby, $theascdesc)
            ->paginate(10);

        return view('/studentlist', compact('students', 'likes', 'orderbys'));
    }
    
    public function createstudentajax(Request $request)
    {
        $newStudent = new Student;
        $newStudent->fname = $request->fname;
        $newStudent->lname = $request->lname;
        $newStudent->snumber = $request->snumber;
        $newStudent->department = $request->department;
        $newStudent->age = $request->age;
        $newStudent->user_id = auth()->user()->id;
        $newStudent->save();
        return response()->json([
            'success' => 'kayit basariyla olusturuldu',
            'theid' => $newStudent->id
        ]);
    }
    public function updatestudentajax(Request $request)
    {
        $check = Student::query()->find($request->id);
        if (auth()->user()->id === $check->user_id) {
            $student = Student::query()->find($request->id);
            $student->fname = $request->fname;
            $student->lname = $request->lname;
            $student->snumber = $request->snumber;
            $student->department = $request->department;
            $student->age = $request->age;
            $student->save();

            return response()->json(['success' => 'kayit basariyla güncellendi ']);
        } else {
            return view('erisimyasak');
        }
    }
    public function deletestudentajax(Request $request)
    {
        $theid = $request->id;
        if ($check = Student::query()->find($theid)) {
            if (auth()->user()->id === $check->user_id) {
                $data = Student::query()->find($theid);
                $data->delete();
                return response()->json(['success' => 'kayit basariyla silindi']);
            } else {
                return view('erisimyasak');
            }
        } else {
            return view('erisimyasak');
        }
    }
}
