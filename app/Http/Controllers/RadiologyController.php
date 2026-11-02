<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RadiologyController extends Controller
{
    public function index()
    {
        $tests = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('radio')) {
                $tests = DB::table('radio')
                    ->leftJoin('lab', 'radio.radiology_category_id', '=', 'lab.id')
                    ->select('radio.*', 'lab.lab_name as category_name')
                    ->orderBy('radio.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.radiology.index', compact('tests'));
    }
}
