<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class IpdController extends Controller
{
    public function index()
    {
        $patients = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('ipd_details')) {
                $patients = DB::table('ipd_details')
                    ->leftJoin('patients', 'ipd_details.patient_id', '=', 'patients.id')
                    ->leftJoin('staff', 'ipd_details.cons_doctor', '=', 'staff.id')
                    ->leftJoin('bed', 'ipd_details.bed', '=', 'bed.id')
                    ->select('ipd_details.*', 'patients.patient_name', 'patients.mobileno', 'patients.gender', 'staff.name as doctor_name', 'staff.surname as doctor_surname', 'bed.name as bed_name')
                    ->orderBy('ipd_details.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.ipd.index', compact('patients'));
    }
}
