<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\Rpd;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'c_users' => User::where('roles', 'user')->count(),
            'rabs' => Rab::with('user', 'type', 'component')->get(),
            'c_rabMenunggu' => Rab::where('status', 'PENGAJUAN')->get(),
            'c_rabDiterima' => Rab::where('status', 'DITERIMA')->get(),
            'c_rabDitolak' => Rab::where('status', 'DITOLAK')->get(),
            'rpds' => Rpd::with('rab')->get(),
            'c_rpdMenunggu' => Rpd::with('rab')->where('status', 'PENGAJUAN')->get(),
            'c_rpdDiterima' => Rpd::with('rab')->where('status', 'DITERIMA')->get(),
            'c_rpdDitolak' => Rpd::with('rab')->where('status', 'DITOLAK')->get(),
        ];
        return view('pages.dashboard', $data);
    }
}
