<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;


class NotifikasiuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemnotif = notification::all();
        $data = array('title' => '= notification',
                    'itemnotif' => $itemnotif);
        return view('notif.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notifikasiuser  $notifikasiuser
     * @return \Illuminate\Http\Response
     */
    public function show(notifikasiuser $notifikasiuser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notifikasiuser  $notifikasiuser
     * @return \Illuminate\Http\Response
     */
    public function edit(notifikasiuser $notifikasiuser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notifikasiuser  $notifikasiuser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notifikasiuser $notifikasiuser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notifikasiuser  $notifikasiuser
     * @return \Illuminate\Http\Response
     */
    public function destroy(notifikasiuser $notifikasiuser)
    {
        //
    }
}
