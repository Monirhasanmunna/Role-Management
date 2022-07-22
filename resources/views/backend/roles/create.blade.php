@extends('backend.main')
@section('content')
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <h4 class="text-primary"><i class="fa-solid fa-circle-check"></i>Roles</h4>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a class="btn btn-primary" href="{{route('app.roles.create')}}"><i class="fa-solid fa-circle-plus p-1"></i><span>Create New</span></a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <form action="{{!isset($role) ? route('app.roles.store') : route('app.roles.update',[$role->id])}}" method="POST">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div style="color: gray;" class="card-title">Manage Role</div>
                            <div class="form-group">
                                <label style="color: #626262;" for="roles">Role Name :</label>
                                <input class="form-control" id="roles" name="name" value="{{isset($role) ? $role->name : old('name')}}" type="text">
                            </div>

                            <div class="text-center mb-4"><strong>Manage Role Permission</strong></div>

                            @forelse ($modules->chunk(2) as $key => $chunk)
                                
                                <div class="row">
                                    @foreach ($chunk as $module)
                                        <div class="col">
                                            <h5>Module : {{$module->name}}</h5>
                                            @foreach ($module->permissions as $permission)
                                                <div class="mb-3 ml-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"  id="flexCheckDefault" name="permission[]" value="{{$permission->id}}">
                                                        <label class="form-check-label" for="flexCheckDefault" >{{$permission->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                    @endforeach
                                </div>
                                
                            @empty
                                <div class="row">
                                    <div class="col">
                                        <strong>No Module Found.</strong>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-3 ml-4 mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection