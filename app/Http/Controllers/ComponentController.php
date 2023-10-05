<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Str;
use App\Http\Requests\ComponentRequest;
use App\Models\Component;
use App\Models\Detail;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'components' => Component::with('detail')->get(),
            'details' => Detail::all(),
            'no' => 1
        ];
        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin Ingin Menghapus Data? Data yang berelasi akan ikut terhapus!";
        confirmDelete($title, $text);
        return view('pages.components.index', $data);
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
    public function store(ComponentRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['code'] = $request->front_code . '.' . $request->code;
        // return $data;
        Component::create($data);

        return redirect()->route('components.index')->with('toast_success', 'Data Berhasil Ditambahkan');
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
    public function update(ComponentRequest $request, Component $component)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['code'] = $request->front_code_edit . '.' . $request->code;
        $component->update($data);

        return redirect()->route('components.index')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('components.index')->with('toast_success', 'Data Berhasil Dihapus');
    }
}
