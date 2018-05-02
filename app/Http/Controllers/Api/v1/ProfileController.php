<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProfileRequest;
use App\Mail\ApplyForm;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * File Upload directory
     *
     * @var string
     */
    private $profileFilesDir = 'uploads/profile-files/';

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
    public function store(ProfileRequest $request)
    {
        //File Upload
        $file = $request->offsetGet('file');
        $fileName = uniqid().'_'.Str::random().'.'.$file->getClientOriginalExtension();
        $file->move(public_path(DIRECTORY_SEPARATOR.$this->profileFilesDir), $fileName);
        $fields = $request->all();
        $fields['file'] = $fileName;

        //Profile Creation
        $profile = Profile::create($fields);

        //Mail Action
        Mail::send(new ApplyForm($profile));

        return response()->json(['success' => true,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
