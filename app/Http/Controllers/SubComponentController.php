<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\Sub_ComponentRequest;
use App\Models\Component;
use Illuminate\Support\Str;
use App\Models\SubComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'sub_components' => SubComponent::with('component', 'user')->where('user_id', Auth::user()->id)->get(),
            'components' => Component::all(),
            'no' => 1
        ];
        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin Ingin Menghapus Data? Data yang berelasi akan ikut terhapus!";
        confirmDelete($title, $text);
        return view('pages.sub_components.index', $data);
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
    public function store(Sub_ComponentRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['code'] = $request->front_code . '.' . $request->code;
        $data['user_id'] = Auth::user()->id;
        SubComponent::create($data);

        return redirect()->route('subs.index')->with('toast_success', 'Data Berhasil Ditambahkan');
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
        $subComponent = SubComponent::find($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['code'] = $request->front_code_edit . '.' . $request->code;
        $data['user_id'] = Auth::user()->id;
        // return $data;
        $subComponent->update($data);

        return redirect()->route('subs.index')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subComponent = SubComponent::find($id);
        $subComponent->delete();

        return redirect()->route('subs.index')->with('toast_success', 'Data Berhasil Diubah');
    }
}
