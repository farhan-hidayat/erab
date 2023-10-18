<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\RabRequest;
use App\Models\Activity;
use App\Models\Classification;
use App\Models\Component;
use App\Models\Detail;
use App\Models\Group;
use Illuminate\Support\Str;
use App\Models\Rab;
use App\Models\Resource;
use App\Models\Type;
use Illuminate\Http\Request;

class RabController extends Controller
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
            'classifications' => Classification::with('activity')->withCount('details')->get(),
            'details' => Detail::with('classification')->withCount('components')->get(),
            'components' => Component::with('detail')->get(),
            'resources' => Resource::all(),
            'groups' => Group::with('resource')->get(),
            'types' => Type::with('group')->get(),
            'rabs' => Rab::with('user', 'component')->get(),
            'no' => 1
        ];
        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin Ingin Menghapus Data? Data yang berelasi akan ikut terhapus!";
        confirmDelete($title, $text);
        return view('pages.rabs.index', $data);
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
    public function store(RabRequest $request)
    {
        $data = $request->all();
        $data['ticket'] = 'RAB-' . date('Ymd') . '-' . Str::random(5);
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 'PENGAJUAN';
        // return $data;
        Rab::create($data);
        return redirect()->route('rabs.index')->with('toast_success', 'Data Berhasil Ditambahkan');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rab $rab)
    {
        $rab->delete();
        toast('Data Berhasil Dihapus', 'success');
        return redirect()->route('rabs.index');
    }
}
