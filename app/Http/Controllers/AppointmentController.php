<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('appointment')) {
                $appointments = DB::table('appointment')
                    ->leftJoin('patients', 'appointment.patient_id', '=', 'patients.id')
                    ->leftJoin('staff', 'appointment.doctor', '=', 'staff.id')
                    ->select('appointment.*', 'patients.patient_name', 'patients.mobileno', 'patients.gender', 'staff.name as doctor_name', 'staff.surname as doctor_surname')
                    ->orderBy('appointment.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.appointments.index', compact('appointments'));
    }
}
