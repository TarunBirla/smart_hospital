<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Appointment;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'opd_count' => 0,
            'ipd_count' => 0,
            'pharmacy_count' => 0,
            'pathology_count' => 0,
            'radiology_count' => 0,
            'blood_bank_count' => 0,
            'ambulance_count' => 0,
            'appointment_count' => 0,
        ];

        $recentAppointments = [];
        $dbConnected = false;

        try {
            DB::connection()->getPdo();
            $dbConnected = true;

            // Safely fetch counts if tables exist
            if ($this->hasTable('opd_details')) {
                $stats['opd_count'] = DB::table('opd_details')->count();
            }
            if ($this->hasTable('ipd_details')) {
                $stats['ipd_count'] = DB::table('ipd_details')->count();
            }
            if ($this->hasTable('pharmacy_bill_basic')) {
                $stats['pharmacy_count'] = DB::table('pharmacy_bill_basic')->count();
            }
            if ($this->hasTable('pathology_report')) {
                $stats['pathology_count'] = DB::table('pathology_report')->count();
            }
            if ($this->hasTable('radio_report')) {
                $stats['radiology_count'] = DB::table('radio_report')->count();
            }
            if ($this->hasTable('blood_issue')) {
                $stats['blood_bank_count'] = DB::table('blood_issue')->count();
            }
            if ($this->hasTable('ambulance_call')) {
                $stats['ambulance_count'] = DB::table('ambulance_call')->count();
            }
            if ($this->hasTable('appointment')) {
                $stats['appointment_count'] = DB::table('appointment')->count();
                $recentAppointments = DB::table('appointment')
                    ->leftJoin('patients', 'appointment.patient_id', '=', 'patients.id')
                    ->select('appointment.*', 'patients.patient_name', 'patients.mobileno')
                    ->orderBy('appointment.id', 'desc')
                    ->limit(5)
                    ->get();
            }

        } catch (Exception $e) {
            $dbConnected = false;
        }

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'dbConnected'));
    }

    private function hasTable($table)
    {
        try {
            return DB::getSchemaBuilder()->hasTable($table);
        } catch (Exception $e) {
            return false;
        }
    }
}
