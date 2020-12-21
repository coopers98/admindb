<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\CreateProfileRequest;
use App\Http\Requests\Profile\DeleteProfileRequest;
use App\Http\Requests\Profile\ListProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Resources\Profile as ProfileResponse;
use App\Http\Resources\ProfileCollection;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return ProfileCollection
     */
    public function index(ListProfileRequest $request)
    {
        //  Process optionally including the profile's interactions
        $includes = $request->get('include', false);

        if ($includes === 'interactions') {
            $profiles = Profile::with('interactions')->paginate();
        } else {
            $profiles = Profile::paginate();
        }

        return new ProfileCollection($profiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ProfileResponse
     */
    public function store(CreateProfileRequest $request)
    {
        $profile = Profile::create($request->validated());

        return new ProfileResponse($profile);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     * @return ProfileResponse
     */
    public function show(Request $request, $id)
    {
        //  Process optionally including the profile's interactions
        $includes = $request->get('include', false);

        if ($includes === 'interactions') {
            $profile = Profile::with('interactions')->findOrFail($id);
        } else {
            $profile = Profile::findOrFail($id);
        }

        return new ProfileResponse($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int                  $id
     * @param UpdateProfileRequest $request
     * @return ProfileResponse
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $profile->update($request->validated());

        return new ProfileResponse($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteProfileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $profile->delete();

        return new \Illuminate\Http\Response();
    }
}
