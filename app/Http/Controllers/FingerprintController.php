<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use App\Http\Requests\StoreFingerprintRequest;
use App\Http\Requests\UpdateFingerprintRequest;

class FingerprintController extends Controller
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
     * @param  \App\Http\Requests\StoreFingerprintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFingerprintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function show(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFingerprintRequest  $request
     * @param  \App\Models\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFingerprintRequest $request, Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fingerprint  $fingerprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fingerprint $fingerprint)
    {
        //
    }
}
