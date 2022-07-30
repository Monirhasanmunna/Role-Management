<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.users.index');
        $users = User::all();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::all();
        $users = User::all();
        return view('backend.user.create',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd ($request);
        $request->validate([
            'name' => 'required|string|unique:users|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'avatar' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2024',
            'role' => 'required',
        ]);

        
        $image = $request->file('avatar');
        $slug = Str::slug($request->name);
        $imageName = '';
        if(isset($image)){

            //make unique name for image`
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('users'))
            {
                Storage::disk('public')->makeDirectory('users');
            }

            $postImage = Image::make($image)->resize(169,169)->stream();
            Storage::disk('public')->put('users/'.$imageName,$postImage);
        }

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'status' => $request->filled('status'),
            'avatar' => $imageName,
        ]);

        notify()->success('User Added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::all();
        return view('backend.user.create',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd ($request);
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'sometimes|confirmed',
            'avatar' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2024',
            'role' => 'required',
        ]);

        
        $image = $request->file('avatar');
        $slug = Str::slug($request->name);
        $imageName = '';
        if(isset($image)){

            //make unique name for image`
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //storage create
            if(!Storage::disk('public')->exists('users')){

                Storage::disk('public')->makeDirectory('users');
            }

            //delete old pic
            if(Storage::disk('public')->exists('users/'.$user->avatar)){

                Storage::disk('public')->delete('users/'.$user->avatar);
            }

            $postImage = Image::make($image)->resize(169,169)->stream();
            Storage::disk('public')->put('users/'.$imageName,$postImage);
        }else{
            $imageName = $user->avatar;
        }

        $user->update([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'status' => $request->filled('status'),
            'avatar' => $imageName,
        ]);

        notify()->success('User Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('app.users.delete');
        //delete old pic
        if(Storage::disk('public')->exists('users/'.$user->avatar)){

            Storage::disk('public')->delete('users/'.$user->avatar);
        }
        $user->delete();
        notify()->error('User Deleted');
        return redirect()->back();
    }
}
