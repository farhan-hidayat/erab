<?php

namespace App\Http\Controllers;

use Exception;
use Alert;
use App\Http\Requests\RabRequest;
use App\Models\Activity;
use App\Models\Classification;
use App\Models\Component;
use App\Models\Detail;
use App\Models\Group;
use App\Models\Program;
use Illuminate\Support\Str;
use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\RabRequest as ModelsRabRequest;
use App\Models\Resource;
use App\Models\SubComponent;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'rabs' => Rab::with('user', 'user.faculty', 'activity')->get(),
            'rab_details' => RabDetail::with('rab', 'sub_component', 'type')->orderBy('sub_component_id', 'asc')->orderBy('type_id', 'asc')->get(),
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
        $data = [
            'activities' => Activity::withCount('classifications')->get(),
            'classifications' => Classification::with('activity')->withCount('details')->get(),
            'details' => Detail::with('classification')->withCount('components')->get(),
            'components' => Component::with('detail')->get(),
            'sub_components' => SubComponent::with('component', 'user')->where('user_id', Auth::user()->id)->get(),
            'programs' => Program::all(),
            'resources' => Resource::all(),
            'groups' => Group::with('resource')->get(),
            'types' => Type::with('group')->get(),
            'rab_requests' => ModelsRabRequest::with('sub_component', 'user', 'type')->where('user_id', Auth::user()->id)->orderBy('sub_component_id', 'asc')->orderBy('type_id', 'asc')->get(),
        ];
        return $data['rab_requests'];
        // return view('pages.rabs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save data user
        $user = Auth::user();
        $user->update($request->except('totalKeseluruhan'));

        //Proses pengajuan rab
        $ticket = 'RAB-' . date('Ymd') . '-' . Str::random(5);
        $rab_requests = ModelsRabRequest::with('user', 'sub_component', 'type')->where('user_id', Auth::user()->id)->get();

        // RAB Create
        $rab = Rab::create([
            'ticket' => $ticket,
            'user_id' => Auth::user()->id,
            'activity_id' => $request->activity_id,
            'year' => date('Y'),
            'price' => $request->totalKeseluruhan,
            'balance' => $request->totalKeseluruhan,
            'status' => 'PENGAJUAN',
        ]);

        foreach ($rab_requests as $rab_request) {
            RabDetail::create([
                'rab_id' => $rab->id,
                'sub_component_id' => $rab_request->sub_component_id,
                'type_id' => $rab_request->type_id,
                'description' => $rab_request->description,
                'volume' => $rab_request->volume,
                'unit' => $rab_request->unit,
                'price' => $rab_request->price,
                'total' => $rab_request->total
            ]);
        }

        //Delete RAB Request data
        ModelsRabRequest::where('user_id', Auth::user()->id)->delete();

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
        $activity = Activity::where('slug', $id)->first();
        $data = [
            'activity' => $activity,
            'classifications' => Classification::with('activity')->where('activity_id', $activity->id)->get(),
            'details' => Detail::with('classification')->withCount('components')->get(),
            'components' => Component::with('detail')->get(),
            'sub_components' => SubComponent::with('component', 'user')->where('user_id', Auth::user()->id)->get(),
            'programs' => Program::all(),
            'resources' => Resource::all(),
            'groups' => Group::with('resource')->get(),
            'types' => Type::with('group')->get(),
            'rab_requests' => ModelsRabRequest::with('sub_component', 'user', 'type')->where('user_id', Auth::user()->id)->orderBy('sub_component_id', 'asc')->orderBy('type_id', 'asc')->get(),
        ];

        return view('pages.rabs.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rab $rab)
    {
        $data = $request->all();
        // Periksa apakah request memiliki data yang dikirimkan
        if ($request->has('price')) {
            $data['price'] = Str::replace(',', '', $data['price']);
            $data['balance'] = $data['price'];
        }

        // Update data jika ada perubahan
        if (!empty($data)) {
            $rab->update($data);
        }

        return redirect()->route('rabs.index')->with('toast_success', 'Data Berhasil Diubah');
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
