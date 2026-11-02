<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use Exception;

class StaffController extends Controller
{
    public function index()
    {
        $staffMembers = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('staff')) {
                $staffMembers = DB::table('staff')
                    ->leftJoin('staff_roles', 'staff.id', '=', 'staff_roles.staff_id')
                    ->leftJoin('roles', 'staff_roles.role_id', '=', 'roles.id')
                    ->select('staff.*', 'roles.name as role_name')
                    ->orderBy('staff.id', 'asc')
                    ->paginate(20);
            }
        } catch (Exception $e) {}

        return view('admin.staff.index', compact('staffMembers'));
    }
}
