<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.role.index');
        $roles = Role::all();
        return view('backend.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.role.create');
        $modules = Module::all();
        return view('backend.roles.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'permission' => 'required',

        ]);

        Role::create([

            'name' => $request->name,
            'slug' => Str::slug($request->name),

        ])->permissions()->sync($request->input('permission'));

        notify()->success("Role Added");
        return redirect()->route('app.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('app.role.edit');
        $modules = Module::all();
        return view('backend.roles.create',compact('modules','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([

            'name' => 'required',

        ]);

        $role->update([

            'name' => $request->name,
            'slug' => Str::slug($request->name),

        ]);
        $role->permissions()->sync($request->input('permission'));

        notify()->info("Role Updated");
        return redirect()->route('app.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('app.role.delete');
        if($role->deletable == true)
        {
            $role->delete();
            notify()->warning("Role Deleted");
            return redirect()->back();
        }else{

            notify()->error("You Can Not Delete System Role");
            return redirect()->back();
        }
    }
}
