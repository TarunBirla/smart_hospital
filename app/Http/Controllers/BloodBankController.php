<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class BloodBankController extends Controller
{
    public function index()
    {
        $products = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('blood_bank_products')) {
                $products = DB::table('blood_bank_products')
                    ->orderBy('id', 'asc')
                    ->get();
            }
        } catch (Exception $e) {}

        return view('admin.blood_bank.index', compact('products'));
    }
}
