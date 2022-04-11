<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionFeature;
use App\Http\Requests\StoreSubscriptionFeatureRequest;
use App\Http\Requests\UpdateSubscriptionFeatureRequest;

class SubscriptionFeatureController extends Controller
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
     * @param  \App\Http\Requests\StoreSubscriptionFeatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionFeatureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionFeature  $subscriptionFeature
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionFeature $subscriptionFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionFeature  $subscriptionFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionFeature $subscriptionFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionFeatureRequest  $request
     * @param  \App\Models\SubscriptionFeature  $subscriptionFeature
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionFeatureRequest $request, SubscriptionFeature $subscriptionFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionFeature  $subscriptionFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionFeature $subscriptionFeature)
    {
        //
    }
}
