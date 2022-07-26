@extends('backend.main')
@section('content')
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <h4 class="text-primary"><i class="fa-solid fa-circle-check"></i>
                @if (isset($role))
                    Roles Update
                @else
                    Roles Create
                @endif
            </h4>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a class="btn btn-primary" href="{{route('app.roles.index')}}"><i class="fa-solid fa-circle-arrow-left"></i><span>Go Back</span></a>
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

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox"  id="select-all">
                                <label class="form-check-label" for="select-all" >Select All</label>
                            </div>

                            @forelse ($modules->chunk(2) as $key => $chunk)
                                <div class="row">
                                    @foreach ($chunk as $module)
                                        <div class="col">
                                            <h5>Module : {{$module->name}}</h5>
                                            @foreach ($module->permissions as $permission)
                                                <div class="mb-3 ml-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="permission[]" value="{{$permission->id}}"
                                                        @if(isset($role))
                                                        @foreach ($role->permissions as $rolePermissions)
                                                            {{$rolePermissions->id == $permission->id ? 'checked' : ''}}
                                                        @endforeach
                                                        @endif
                                                        >
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
                            @if (isset($role))
                                <button type="submit" class="btn btn-primary">Update</button> 
                            @else
                               <button type="submit" class="btn btn-primary">Create</button> 
                            @endif
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    
<script>

    $('#select-all').click(function(event){

        if(this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;
            });
        }else{
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }

    });

</script>
@endsection