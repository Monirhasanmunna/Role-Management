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
            <a class="btn btn-primary" href="{{route('app.roles.create')}}"><i class="fa-solid fa-circle-plus p-1"></i><span>Create New</span></a>
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
                                            <a class="btn btn-primary btn-sm" href="{{route('app.roles.edit',[$role->id])}}"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>

                                            @if($role->deletable == true)
                                            {{-- <button onclick="deleteData($role->id)" class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-trash"></i><span>Delete</span></button> --}}

                                            <form action="{{route('app.roles.destroy',[$role->id])}}" method="POST" style="display" class="btn btn-danger btn-sm ">
                                                @csrf
                                                @method('DELETE')
                                                <button class="show-alert-delete-box " onclick="deleteData($role->id)" style="border:none;background-color: transparent; color:white;" type="submit"><i class="fa-solid fa-trash"></i><span>Delete</span></button>
                                            </form>
                                            @endif
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
