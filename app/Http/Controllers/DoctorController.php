<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Doctor_department;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        return view('home', [
            'title' => "Home ",
        ]);
    }

    public function index() {
        $departments = Department::pluck('department_name');
       // return view('doctor_register')->with(compact('specializations'));
        return view('doctors.add')->with(compact('departments'));
    }
    public function add_department()
    {
        return view('department.add');
    }
    public function store_department(Request $request)
    {
        $validate = $request->validate([
            "department_name" => 'required|max:255|regex:/^[A-Za-z\s]+$/|unique:departments'
        ]);
        Department::create([
            'department_name' => $validate["department_name"],
        ]);
        return redirect()->route('home')->with('status', 'Department added successfully');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function show_department()
    {
        $department=Department::all();
        return view('department.show',['departments'=>$department]);
    }
    public function edit_department($department_id)
    {
        $department=Department::findorfail($department_id);
        return view('department.update',['department'=>$department]);
    }
    public function update_department(request $edited_department)
    {
        $department_id=$edited_department["id"];
        $validate = $edited_department->validate([
            "department_name" => 'required|max:255|regex:/^[A-Za-z\s]+$/|unique:departments'
        ]);
        $department=Department::findorfail($department_id);
        $department["department_name"]=$validate["department_name"];
        $department->update();
        return redirect()->route('home')->with('status', 'department updated successfully');

    }
    public function delete_department($department_id)
    {
        $department= Department::findOrFail($department_id);
        $department->delete();
        return redirect()->route('home')->with('status','department deleted successfully');
    }
    public function store(Request $request)
    {
        $validate=$request->validate([
            "first_name"=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            "last_name"=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            "qualification"=>'required|max:255',
            "designation"=>'required|max:255',
            "image"=>'required|image|mimes:jpeg,jpg,png,gif,svg|max:1048',
        ]);
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
        $doctor=Doctor::create([
            'first_name'=>$validate["first_name"],
            'last_name'=>$validate["last_name"],
            'qualification'=>$validate["qualification"],
            'designation'=>$validate["designation"],
            'department'=>$request['department_name'],
            'image'=>$imageName,
        ]);
        $departmentName=$request['department_name'];
        $department=Department::where('department_name',$departmentName)->firstorfail();
        Doctor_department::create([
           'doctor_id'=>$doctor["id"],
           'department_id'=>$department['id'],
        ]);
        return redirect()->route('home')->with('status', 'Doctor added successfully');
    }

    public function create()
    {
        $departments=[];
        $doctors=Doctor::all();
        return view('doctors.show')->with(compact('doctors'));

    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $doctor=Doctor::findorfail($doctor['id']);
        $doctor_department=Doctor_department::where('doctor_id',$doctor['id'])->firstorfail();
        $department=Department::find($doctor_department['department_id']);
        $department_name=$department['department_name'];
        $departments=Department::all();
        return view('doctors.edit')->with(compact('doctor','departments','department_name'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validate=$request->validate([
            "first_name"=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            "last_name"=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            "qualification"=>'required|max:255',
            "designation"=>'required|max:255',
            "image"=>'image|mimes:jpeg,jpg,png,gif,svg|max:1048',
            ]);
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
//        dd($request["department_name"]);
        $doctor->first_name=$validate["first_name"];
        $doctor->last_name=$validate["last_name"];
        $doctor->qualification=$validate["qualification"];
        $doctor->designation=$validate["designation"];
        $doctor->image=$imageName;
        $doctor->update();
        $department=Department::where('department_name',$request["department_name"])->firstorfail();
        $doctor_department=Doctor_department::where('doctor_id',$request["id"])->firstorfail();
        $doctor_department->department_id=$department["id"];
        $doctor_department->update();
        return redirect()->route('home')->with('status', 'Doctor updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor=Doctor::findorfail($doctor["id"]);
        $doctor_department=Doctor_department::where('doctor_id',$doctor["id"])->firstorfail();
        $doctor_department->delete();
        $doctor->delete();
        return redirect()->route('home')->with('status','doctor deleted successfully');

    }
    public function add_consultation()
    {
        $doctors=Doctor::pluck('first_name');
        return view('consultation.add')->with(compact('doctors'));
    }
    public function storeConsultation(request $request)
    {
        $date=Carbon::now()->toDateString();
        $validate=$request->validate([
           "duration"=>'required|integer|max:60',
            "day"=>'required',
            "startDate"=>'required','after_or_equal:',
            "start_time"=>'required',
            "end_time"=>'required',
        ]);
        $startDate=(new carbon($validate["startDate"]))->format('Y-m-d');
        $input['day'] = json_encode($validate['day']);
        $doctor=Doctor::where('first_name', $request['first_name'])->firstorfail();
        $id=$doctor["id"];
//        $startTime=(new carbon($validate["start_time"]))->format("h:i A");
//        $endTime=(new carbon($validate["end_time"]))->format("h:i A");
//        $result=Consultation::where('doctor_id',$id)->where('date',$startDate)->firstorfail();
        $result=Timeslot::where('doctor_id',$id)->where('date',$startDate)->firstorfail();
        if($result==null) {
            $consultation = Consultation::create([
                'doctor_id' => $id,
                'day' => $input['day'],
                'duration' => $validate["duration"],
                'date' => $date,
                'start_time' => $validate["start_time"],
                'end_time' => $validate["end_time"],
            ]);

            $t = $validate["start_time"];
            $e = $validate["end_time"];
//        $start_time=(new carbon($startDate))->format('Y-m-d')."$t";
            $start_time = today()->format('Y-m-d') . "$t";
            $end_time = today()->addDays('1')->format('Y-m-d') . "$e";
//        $end_time=(new carbon($startDate))->addDays('1')->format('Y-m-d') . "$e";
            $duration = $validate["duration"] . ' minutes';
            $period = new CarbonPeriod(new Carbon($start_time), $duration, new Carbon($e));
            $slots = [];
            foreach ($period as $item) {

                array_push($slots, $item->format("h:i A"));
            }
            $days = $validate['day'];
            for ($i = 0; $i < 4; $i++) {
                do {
                    $startDay = (new carbon($startDate))->dayName;
                    if (in_array($startDay, $days)) {

                        foreach ($slots as $slot) {
                            $slot = Timeslot::create([
                                'doctor_id' => $id,
                                'date' => $startDate,
                                'day' => $startDay,
                                'start_time' => $slot,
                            ]);
                        }
                    }
                    $startDate = (new carbon($startDate))->addDay();

                } while ($startDay !== "Sunday");

            }

            return redirect()->route('home')->with('status', 'Consultation details added successfully and corresponding time slots are generated');
        }
        return redirect()->route('home')->with('status','Consultation already exist');
        //return view('consultation.timeslot')->with(compact('id','slots'))->with('status','Consultation details added successfully');
    }
    public function show_consultation()
    {
        $doctors = Doctor::all();
        return view('consultation.show', ['doctors' => $doctors]);
    }
    public function details_consultation(Request $request)
    {
         $consultations=Consultation::where('doctor_id',$request['id'])->get();
        $doctor_name=Doctor::where('id',$request['id'])->value('first_name');
        $html="<h6>Dr. ".$doctor_name."   Consultation Details</h6>"."<table>".
                       "<tr>".
                            "<th>Id"."</th>".
                            "<th>Day"."</th>".
                            "<th>Duration"."</th>".
                            "<th>Start Time"."</th>".
                            "<th>End Time"."</th>".
                       "</tr>";
        foreach ($consultations as $consultation) {
                    $html = $html .
                        "<tr>" .
                        "<td>" . $consultation->id . "</td >" .
                        "<td >" . $consultation->day . "</td >" .
                        "<td >" . $consultation->duration . "</td >" .
                        "<td >" . $consultation->start_time . "</td >" .
                        "<td >" . $consultation->end_time . "</td >" .
//                "<td>"."<button type='button' id='edit' value=".$consultation->id." data-value=".$request['id'].">"." <h6>  Edit "."</h6>"."</button>"."</td>".
                        "<td>" . "<button type='button' id='delete' value=" . $consultation->id . " data-value=" . $request['id'] . ">" . " <h6>  Delete " . "</h6>" . "</button>" . "</td>" .
                        "</tr >";
        }

        $html=$html."</table>";
        return response()->json(['html'=>$html]);
    }
    public function consultation_delete(Request $request)
    {
        $consultation=Consultation::findorfail($request['consultation_id']);
        $delete=$consultation->delete();
        if($delete==1){
            echo "Consultation deleted successfully";
        }
        else{
            echo "Error for deleting consultation";
        }

    }
    public function time_slot($doctor_id)
    {
        $doctor_name = Doctor::where('id', $doctor_id)->value('first_name');
        $consultations = Consultation::where('doctor_id', $doctor_id)->get();
        if($consultations->isEmpty())
        {
            return redirect('home')->with('status','No slots available');
        }
        $days=json_decode($consultations[0]->day, true);
        $date=$consultations[0]->date;
        $booked_slot=[];
         foreach ($days as $day) {
                $booked_slots[$day] = Timeslot::where('doctor_id', $doctor_id)
                    ->where('day',$day)
                    ->where('booked', 1)
                    ->orderby('id', 'asc')
                    ->get();
                foreach ($booked_slots[$day] as $booked_slot[$day]) {
                    $id=$booked_slot[$day]->user_id;
                    $booked_slot[$day]->user_id = User::where('id', $id)->value('name');
                }
            }

        foreach ($days as $day) {
            $available_slots[$day] = Timeslot::where('doctor_id', $doctor_id)
                ->where('day',$day)
                ->where('booked', 0)
                ->orderby('id', 'asc')
                ->get();
        }
            return view('consultation.timeslot')->with(compact('consultations', 'booked_slots','available_slots','days','doctor_name','doctor_id'));

    }
    public function date_slot(Request $request){
        $slots_booked=Timeslot::where('doctor_id',$request['id'])
                        ->where('date',$request['date'])
                        ->where('booked',1)
                        ->orderby('id','asc')
                        ->get();
        $slots_available=Timeslot::where('doctor_id',$request['id'])
            ->where('date',$request['date'])
            ->where('booked',0)
            ->orderby('id','asc')
            ->get();
        $html=" <div class='row'>";
        foreach ($slots_booked as $slot)
        {
            $patient_name=User::where('id',$slot->user_id)->value('name');
            //print_r($doctor-name;exit();
            $html=$html."<div class='col'>Patient name : ".$patient_name. "<div class='slot1'  data-value=".$slot->id.">".$slot->start_time.
                "</div>"."</div>";

        }
        $html=$html."</div>";
        $html1=" <div class='row'>";
        foreach ($slots_available as $slot)
        {
            $i=
            //print_r($doctor-name;exit();
            $html1=$html1."<div class='col'>". "<div class='slot'  data-value=".$slot->id.">".$slot->start_time.
                "</div>"."</div>";

        }
        $html1=$html1."</div>";
        return response()->json(['html'=>$html,'html1'=>$html1]);


    }
}
