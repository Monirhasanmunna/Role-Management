@extends('backend.main')
@section('css')
<!-- Datatable -->
<link href="{{asset('backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <h4 class="text-primary"><i class="fa-solid fa-circle-check"></i>Roles</h4>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a class="btn btn-primary" href="{{route('app.user.create')}}"><i class="fa-solid fa-circle-plus p-1"></i><span>Create New</span></a>
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
                                <tr role="row" class="text-center">
                                    <th style="width:30px;">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Join at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $key => $user)
                                    <tr role="row" class="text-center" style="color: black;">
                                        <td>#{{$key+1}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="40" class="rounded-circle" src="{{config('app.placeholder').'160'}}" alt="User Avatar">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $user->name }}</div>
                                                        <div class="widget-subheading opacity-7">
                                                            @if ($user->role)
                                                                <span class="badge badge-info">{{ $user->role->name }}</span>
                                                            @else
                                                                <span class="badge badge-danger">No role found :(</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if ($user->status == true)
                                                <span class="badge bg-primary" style="color: wheat;">Active</span>
                                            @else
                                                <span class="badge bg-danger" style="color: wheat;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route('app.user.edit',[$user->id])}}"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                                            {{-- <button onclick="deleteData($role->id)" class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-trash"></i><span>Delete</span></button> --}}

                                            <form action="{{route('app.user.destroy',[$user->id])}}" method="POST" style="display" class="btn btn-danger btn-sm ">
                                                @csrf
                                                @method('DELETE')
                                                <button class="show-alert-delete-box " onclick="deleteData($user->id)" style="border:none;background-color: transparent; color:white;" type="submit"><i class="fa-solid fa-trash"></i><span>Delete</span></button>
                                            </form>
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

{{-- <script>
    function deleteData(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-'+id).submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
}
</script> --}}

</script>
<script type="text/javascript">
 $('.show-alert-delete-box').click(function(event){
     var form =  $(this).closest("form");
     var name = $(this).data("name");
     event.preventDefault();

     swal({
         title: "Are you sure you want to delete this post?",
         text: "If you delete this, it will be gone forever.",
         icon: "warning",
         type: "warning",
         buttons: ["Cancel","Yes!"],
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, post deleted successfully!'
     }).then((willDelete) => {
         if (willDelete) {
             form.submit();
         }
     });
 });
</script>
@endsection
