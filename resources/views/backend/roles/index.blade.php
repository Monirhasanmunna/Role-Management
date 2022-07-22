@extends('backend.main')
@section('css')
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<!-- Datatable -->
<link href="{{asset('backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <h4 style="color: #65656B;">Roles</h4>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a class="btn btn-primary" href="#">Add New</a>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example_wrapper" class="dataTables_wrapper">
                        <table id="example" class="display dataTable" style="padding-top:5px;padding-bottom:5px;" role="grid"
                            aria-describedby="example_info">
                            <thead>
                                <tr role="row" style="text-align: center;">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                        >#</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending"
                                        >Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                        aria-label="Age: activate to sort column ascending">
                                        Permission</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                        aria-label="Start date: activate to sort column ascending"
                                        >Updated at</th>
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                        aria-label="Salary: activate to sort column ascending"
                                        >Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $key => $role)
                                    <tr role="row" style="color: black; text-align:center;">
                                        <td>#{{$key+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @if ($role->permissions->count() > 0)
                                                <span class="badge bg-primary" style="color: wheat;">{{$role->permissions->count()}}</span>
                                            @else
                                                <span class="badge bg-danger" style="color: wheat;">No permission found :(</span>
                                            @endif
                                        </td>
                                        <td>{{$role->updated_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route('app.roles.edit',[$role->id])}}"><i class='bx bxs-edit '></i><span>Edit</span></a>

                                            <button class="btn btn-danger btn-sm" type="submit"><i class='bx bxs-message-square-x'></i><span>Delete</span></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Datatable -->
<script src="{{asset('backend/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/plugins-init/datatables.init.js')}}"></script>
@endsection
