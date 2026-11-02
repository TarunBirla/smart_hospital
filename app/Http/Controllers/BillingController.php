<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class BillingController extends Controller
{
    public function index()
    {
        $bills = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('pharmacy_bill_basic')) {
                $bills = DB::table('pharmacy_bill_basic')
                    ->leftJoin('patients', 'pharmacy_bill_basic.patient_id', '=', 'patients.id')
                    ->select('pharmacy_bill_basic.*', 'patients.patient_name')
                    ->orderBy('pharmacy_bill_basic.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.billing.index', compact('bills'));
    }
}
