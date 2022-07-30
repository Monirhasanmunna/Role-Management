@extends('backend.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <h4 class="text-primary"><i class="fa-solid fa-circle-check"></i>
                @if (isset($user))
                    User Update
                @else
                    User Create
                @endif
            </h4>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a class="btn btn-primary" href="{{route('app.user.index')}}"><i class="fa-solid fa-circle-arrow-left"></i><span>Go Back</span></a>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <form action="{{!isset($user) ? route('app.user.store') : route('app.user.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        
                        <div class="row">
                            <div class="col-7">
                                <div class="card-body">
                                    <div style="color: gray;" class="card-title">User Information</div>
                                    <div class="form-group">
                                        <label style="color: #626262;" for="name"><strong>Name :</strong></label>
                                        <input class="form-control" id="name" name="name" value="{{isset($user) ? $user->name : old('name')}}" type="text"
                                        class="@error('name') is-invalid @enderror">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #626262;" for="email"><strong>Email :</strong></label>
                                        <input class="form-control" id="email" name="email" value="{{isset($user) ? $user->email : old('email')}}" type="email"
                                        class="@error('email') is-invalid @enderror">

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #626262;" for="password"><strong>Password :</strong></label>
                                        <input class="form-control" id="password" name="password" type="password"
                                        class="@error('password') is-invalid @enderror">

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #626262;" for="confirm-password"><strong>Confirm Password :</strong></label>
                                        <input class="form-control" id="confirm-password" name="password_confirmation" type="password">
                                    </div>
                                </div>
                            
                            </div>

                            <div class="col-5">
                                <div class="card-body">
                                    <div style="color: gray;" class="card-title">Role and Avatar select</div>

                                    <div class="form-group">
                                        <label style="color: #626262;" for="select"><strong>Role :</strong></label>
                                        <select class="js-example-basic-single" id="select" name="role"
                                        class="@error('role') is-invalid @enderror">
                                            @foreach ($roles as $role)
                                              <option value="{{$role->id}}" 
                                                {{$role->id == $user->role_id ? 'selected' : ''}}
                                                >{{$role->name}}</option>  
                                            @endforeach
                                          </select>

                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label style="color: #626262;" for="avatar"><strong>Avatar :</strong></label>
                                        <input class="form-control dropify" id="avatar" data-default-file="{{isset($user) ? asset('storage/users/'.$user->avatar) : ''}}" name="avatar" type="file"
                                        class="@error('avatar') is-invalid @enderror">

                                        @error('avatar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" {{$user->status == 1 ? 'checked' : ''}} id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Status</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-3 ml-4 mb-3">
                                    @if (isset($user))
                                        <button type="submit" class="btn btn-primary">Update</button> 
                                    @else
                                       <button type="submit" class="btn btn-primary">Create New</button> 
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.dropify').dropify();
        $('.js-example-basic-single').select2();
    });
</script>
@endsection