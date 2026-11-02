<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OpdController extends Controller
{
    public function index()
    {
        $patients = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('opd_details')) {
                $patients = DB::table('opd_details')
                    ->leftJoin('patients', 'opd_details.patient_id', '=', 'patients.id')
                    ->leftJoin('staff', 'opd_details.cons_doctor', '=', 'staff.id')
                    ->select('opd_details.*', 'patients.patient_name', 'patients.guardian_name', 'patients.gender', 'patients.mobileno', 'staff.name as doctor_name', 'staff.surname as doctor_surname')
                    ->orderBy('opd_details.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.opd.index', compact('patients'));
    }
}
