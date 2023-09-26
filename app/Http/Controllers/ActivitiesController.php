<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Str;
use App\Http\Requests\ActivitiesRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'activities' => Activity::all(),
            'no' => 1
        ];
        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin Ingin Menghapus Data?";
        confirmDelete($title, $text);
        return view('pages.activities.index', $data);
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
    public function store(ActivitiesRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Activity::create($data);

        return redirect()->route('activities.index')->with('toast_success', 'Data Berhasil Ditambahkan');
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
    public function update(ActivitiesRequest $request, Activity $activity)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $activity->update($data);

        return redirect()->route('activities.index')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('toast_success', 'Data Berhasil Dihapus');
    }
}
