<?php

namespace App\Http\Controllers;

use App\Http\Requests\Interaction\CreateInteractionRequest;
use App\Http\Requests\Interaction\UpdateInteractionRequest;
use App\Http\Resources\Interaction as InteractionResponse;
use App\Http\Resources\InteractionCollection;
use App\Models\Interaction;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InteractionCollection
     */
    public function index()
    {
        return new InteractionCollection(Interaction::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return InteractionResponse
     */
    public function store(CreateInteractionRequest $request)
    {
        $interaction = Interaction::create($request->validated());

        return new InteractionResponse($interaction);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return InteractionResponse
     */
    public function show($id)
    {
        $interaction = Interaction::findOrFail($id);
        return new InteractionResponse($interaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return InteractionResponse
     */
    public function update(UpdateInteractionRequest $request, $id)
    {
        $interaction = Interaction::findOrFail($id);

        $interaction->update($request->validated());

        return new InteractionResponse($interaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(
        $id
    ) {
        $profile = Interaction::findOrFail($id);

        $profile->delete();

        return new \Illuminate\Http\Response();

    }
}
