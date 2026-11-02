<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PharmacyController extends Controller
{
    public function index()
    {
        $medicines = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('pharmacy')) {
                $medicines = DB::table('pharmacy')
                    ->leftJoin('medicine_category', 'pharmacy.medicine_category_id', '=', 'medicine_category.id')
                    ->select('pharmacy.*', 'medicine_category.medicine_category')
                    ->orderBy('pharmacy.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.pharmacy.index', compact('medicines'));
    }
}
