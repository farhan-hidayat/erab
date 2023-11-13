<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Str;
use App\Http\Requests\Rab_RequestRequest;
use App\Models\RabRequest;
use Illuminate\Http\Request;

class RabRequestComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Rab_RequestRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['price'] = preg_replace('/[^0-9]/', '', $data['price']);
        $data['total'] = $data['price'] * $data['volume'];
        // $data['total'] = preg_replace('/[^0-9]/', '', $data['total']);
        // return $data;
        RabRequest::create($data);

        return redirect()->back()->with('toast_success', 'Data Berhasil Ditambahkan');
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
    public function destroy($id)
    {
        //
    }
}
