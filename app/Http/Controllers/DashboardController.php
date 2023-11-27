<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\Rpd;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'c_users' => User::where('roles', 'user')->count(),
            'rabs' => Rab::with('user', 'type', 'activity')->get(),
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

    public function cetak_pdf($id)
    {
        $data = [
            'rab' => Rab::find($id),
            'rab_details' => RabDetail::with('rab', 'sub_component', 'type')->where('rab_id', $id)->orderBy('sub_component_id', 'asc')->orderBy('type_id', 'asc')->get()
        ];
        // return $data;
        $pdf = PDF::loadView('pages.rabs.cetak_pdf', $data);
        // return $pdf->download('laporan-rab');
        set_time_limit(200);
        return $pdf->stream();
    }
}
