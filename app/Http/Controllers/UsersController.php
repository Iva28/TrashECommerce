<?php

namespace App\Http\Controllers;


use Collective\Html\FormBuilder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('my-profile')->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
            'phone' => 'required|string',
            'avatar' => 'required|string'
            //'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update($input);
        return back()->with('success_message', 'Profile updated successfully!');
    }
    
    public function uploadImage(Request $request) {
        $request->validate([
            'fileToUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // dd($request->files->all());
        $file = $request->file('fileToUpload');
        $fileName = 'file_'.time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/uploaded', $fileName);
        //return "storage/uploaded/$fileName";
        return "uploaded/$fileName";
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
