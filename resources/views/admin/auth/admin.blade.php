@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">


     @if (Session::has('deleteAdmin'))
        <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('deleteAdmin')}}

          {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-1">
                    <a href="{{route('admin#userList')}}">
                        <button class="btn btn-sm btn-outline-dark">User List</button>
                    </a>
                    <a href="{{route('admin#adminList')}}">
                        <button class="btn btn-sm btn-outline-dark">Admin List</button>
                    </a>
                </h3>

                <div class="card-tools">
                  <form action="{{route('admin#adminSearch')}}" method="get">
                      @csrf
                    <div class="input-group input-group-sm mt-1" style="width: 150px;">
                        <input type="text" name="searchData" value="" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default btn-secondary ">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th> Name</th>
                      <th> Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($admin as $adminList)
                        <tr>
                            <td>{{$adminList->id}}</td>
                            <td>{{$adminList->name}}</td>
                             <td>{{$adminList->email}}</td>
                            <td>{{$adminList->phone}}</td>
                            <td>{{$adminList->address}}</td>
                            <td>
                                <a href="{{ route('admin#adminDelete',$adminList['id'])}}">
                                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                  {{-- <span class="mt-1 ms-2">{{$user->links()}}</span> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
