<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class SettingController extends Controller
{
    public function index()
    {
        $settings = null;
        try {
            if (DB::getSchemaBuilder()->hasTable('sch_settings')) {
                $settings = DB::table('sch_settings')->first();
            }
        } catch (Exception $e) {}

        return view('admin.settings.index', compact('settings'));
    }
}
