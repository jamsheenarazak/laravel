<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'phone',
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}

//
//namespace App\Http\Controllers;
//
//use App\Models\Doctor;
//use App\Models\Doctor_department;
//use App\Models\Department;
//use Illuminate\Http\Request;
//
//class DoctorController extends Controller
//{
//    public function index()
//    {
//        return view('clinic_welcome', [
//            'title' => "Welcome ",
//        ]);
//    }
//
//    public function add_specialization()
//    {
//        return view('add_specialization');
//    }
//
//    public function store(request $request)
//    {
//        $validate = $request->validate([
//            "specialization_name" => 'required|max:255|regex:/^[A-Za-z\s]+$/|unique:specializations'
//        ]);
//        Department::create([
//            'specialization_name' => $validate["specialization_name"],
//        ]);
//        return redirect()->route('home')->with('status', 'specialization added successfully');
//    }
//
//    public function register()
//    {
//        $specializations = specialization::pluck('specialization_name');
//
//        return view('doctor_register')->with(compact('specializations'));
//    }
//
//    public function store_doctors(request $request)
//    {
//        Doctor::create([
//            'first_name' => $request["first_name"],
//            'last_name' => $request["last_name"],
//            'professional_statement' => $request["professional_statement"],
//            'practising_from' => $request["practicing_from"],
//        ]);
//        $specialization = $request["specialization_name"];
//        echo $specialization;
//        //Doctor_department::
//        //return redirect()->route('home')->with('status','specialization added successfully');
//    }
//}
