<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PathologyController extends Controller
{
    public function index()
    {
        $tests = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('pathology')) {
                $tests = DB::table('pathology')
                    ->leftJoin('pathology_category', 'pathology.pathology_category_id', '=', 'pathology_category.id')
                    ->select('pathology.*', 'pathology_category.category_name')
                    ->orderBy('pathology.id', 'desc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.pathology.index', compact('tests'));
    }
}
