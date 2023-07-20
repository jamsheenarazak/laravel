<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Mail\Bookedmail;
use App\Models\Consultation;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Timeslot;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailJob;
use App\providers\AppointmentCancelled;
class
HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('clinic_welcome', [
            'title' => "Home",
        ]);
    }

    public function patient_register(Request $request)
    {
        return view('patient.registration');
    }

    public function display_doctors()
    {        $doctors = Doctor::all();
        return view('clinic.doctor', ['title' => "Doctors"])->with(compact('doctors'));
    }

    public function display_department()
    {
        $departments = Department::all();
        return view('clinic.department', compact('departments'));
    }

    public function departmentDoctor(Request $request)
    {
        $doctors = Doctor::where('department', $request['departmentName'])->get();
        $html = view('clinic.department_doctor', compact('doctors'))->render();
        return response()->json(['html' => $html]);
    }

    public function make_appointment()
    {

        return view('clinic.appointment', ['title' => "appointment"]);
    }

    public function doctor_list(Request $request)
    {
        $validate = $request->validate([
            "date" => 'required|after_or_equal:'
        ]);
        $date = $validate['date'];
        $day_appointment = Carbon::createFromFormat('Y-m-d', $date)->format('l');
        $consultations = Consultation::all();
        $doctor_ids = [];
        foreach ($consultations as $consultation) {

            $days = json_decode(($consultation->day), true);
            foreach ($days as $day) {
                if (strcmp($day, $day_appointment) == 0) {
                    array_push($doctor_ids, $consultation->doctor_id);
                }
            }
        }

        $doctors = Doctor::whereIn('id', $doctor_ids)->get();
        $html = view('clinic.doctor_list', compact('doctors','date'))->render();

        return response()->Json(['html' => $html]);
    }

    public function slot(Request $request)
    {
        $request['id'];
        $date = $request['date'];
        $day = Carbon::createFromFormat('Y-m-d', $request['date'])->dayName;
        $slots = Timeslot::where('doctor_id', $request['id'])
            ->where('date',$date)
            ->where('day', $day)
            ->where('booked', 0)
            ->orderby('id', 'asc')
            ->get();
        if ($slots->isNotEmpty()) {

            $html = "<h1>Select time slot</h1>" . "<div style='height: 600px;'>" . "<div class='grid-container'>";
            foreach ($slots as $slot) {

                //print_r($doctor-name;exit();
                $html = $html . "<button type='button' class='btn btn-primary'>" . "<div class='slot'   data-value=" . $slot->id . " data-value1=" . $date . ">" . $slot->start_time .
                    "</div>" . "</button>";

            }
            $html = $html . "</div>" . "</div>";
            return $html;

        } else {

            echo "Booking full";
        }
    }


    public function book_slot(Request $request)
    {
        $slot_id = $request['id'];
        $date = $request['date'];
        $user_name = Auth::user()->name;
        $slot = Timeslot::where('id', $request['id'])->get();
        $time = $slot[0]->start_time;
        $doctor = Doctor::where('id', $slot[0]->doctor_id)->value('first_name');
        $array = array('booked' => 1, 'date' => $date, 'user_id' => Auth::user()->id);
        $update = Timeslot::where('id', $slot_id)
            ->where('date',$date)
            ->update(array('booked' => 1, 'date' => $date, 'user_id' => Auth::user()->id));
        $mail = 'jamsheashiq@gmail.com';
        try {

            dispatch(new SendEmailJob($mail))->delay(Carbon::now()->addMinute(1));
            echo "mail send";
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
        if ($update) {
            echo " Successfully Booked Slot";
        } else {
            echo " Failed to Book Slot";
        }

    }
    public function patient_history()
    {
        $userName = Auth::user()->name;
        $id = Auth::user()->id;
        $userEmail = Auth::user()->email;
        $slots = Timeslot::where('user_id', $id)->where('booked', 1)->get();
        $doctor = [];
        foreach ($slots as $slot) {
            $doctor[$slot->doctor_id] = Doctor::where('id', $slot->doctor_id)->value('first_name');
        }
        $flag=[];
        foreach ($slots as $slot) {
            $bookingDate = $slot->date;
            $bookingTime = $slot->start_time;
            $date1 = $bookingDate . ' ' . $bookingTime;
            $cancelDate1 = Carbon::now()->format('Y-m-d H:i A');
            $cancelDate = Carbon::createFromFormat('Y-m-d H:i A', $cancelDate1);
            $date2 = Carbon::createFromFormat('Y-m-d H:i A', $date1);
            $date = $date2->subHours(6);
            $result = $cancelDate->lte($date);
            if ($result == 'true') {
                $flag[$slot->id] = 1;
            } else {
                $flag[$slot->id] = 0;
            }
        }
            $html = view('patient.history', compact('userName', 'flag', 'userEmail', 'slots', 'doctor'))->render();
        return response()->json(['html' => $html]);
    }
    public function appointment_cancel(Request $request)
    {
            $update = Timeslot::where('id', $request['slot_id'])->update(array('booked' => 0, 'user_id' => 0));
            $user=Auth::user();
            if ($update) {
                echo "Booking has been successfully cancelled";
                AppointmentCancelled::dispatch($user);
            } else {
                echo "error";
            }
    }
    public function deleteAppointment()
    {
        $slots=Timeslot::all();
        foreach ($slots as $slot){
            $date = Carbon::now()->format('Y-m-d');
            $todayDate = Carbon::parse( $date);
            $booking=$slot->date;
            $bookingDate = Carbon::parse($booking);
            $result = $bookingDate->lessThan($todayDate);
            if($result=='true'){
                $delete=Timeslot::findorfail($slot->id)->delete();
                if($delete==1){
                    echo "slot deleted";
                }
                else{
                    echo "error";
                }
            }


        }
    }



}
