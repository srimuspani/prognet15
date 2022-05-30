<?php

namespace App\Http\Controllers;

use App\Models\notifikasi;
use Illuminate\Http\Request;
use DB;
use App\Models\adminnotification;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemnotif = adminnotification::all();
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
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(notifikasi $notifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(notifikasi $notifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notifikasi $notifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(notifikasi $notifikasi)
    {
        //
    }
}
