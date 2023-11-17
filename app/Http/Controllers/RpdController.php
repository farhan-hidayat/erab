<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\RpdRequest;
use App\Models\Activity;
use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\Rpd;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'activities' => Activity::withCount('classifications')->get(),
            'rabs' => Rab::with('activity', 'user', 'user.faculty')->get(),
            // 'rabs' => Rab::with('activity', 'user', 'user.faculty')->where('status', 'DITERIMA')->get(),
            'rpds' => Rpd::with('rab')->get(),
            'rab_details' => RabDetail::with('rab', 'sub_component', 'type')->orderBy('sub_component_id', 'asc')->orderBy('type_id', 'asc')->get(),
            'no' => 1
        ];
        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin Ingin Menghapus Data? Data yang berelasi akan ikut terhapus!";
        confirmDelete($title, $text);
        return view('pages.rpds.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RpdRequest $request)
    {
        $data = $request->all();
        $saldo = Rab::where('id', $data['rab_id'])->first();
        $data['ticket'] = 'RPD-' . date('Ymd') . '-' . Str::random(5);
        $data['price'] = Str::replace(',', '', $data['price']);
        $data['balance'] = $saldo->balance - $data['price'];
        $data['status'] = 'PENGAJUAN';
        // return $data;
        Rpd::create($data);
        Rab::where('id', $data['rab_id'])->update(['balance' => $data['balance']]);

        return redirect()->route('rpds.index')->with('toast_success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rpd $rpd)
    {
        $data = $request->all();
        // return $data;
        $rpd->update($data);

        return redirect()->route('rpds.index')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rpd $rpd)
    {
        $rpd->delete();
        toast('Data Berhasil Dihapus', 'success');
        return redirect()->route('rpds.index');
    }
}
