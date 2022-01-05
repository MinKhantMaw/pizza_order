@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                       
                         <h4 class="my-3">{{$pizza[0]->categoryName}}</h4>
                        <div class="card">
                           
                            <div class="card-header">
                                {{-- <h5 class="card-title mt-1 text-bold">
                                    category item details
                                </h5> --}}
                                <b><span>Total Item - </span> {{ $pizza->total()}} </b>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image </th>
                                            <th>Pizza Name</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pizza as $item)
                                            <tr>
                                                <td>{{ $item->pizza_id }}</td>
                                                <td>
                                                    <img style="width:100px" src="{{ asset('images/' . $item->image) }}"
                                                        alt="">
                                                </td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>{{ $item->price }} Kyats</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- pagination --}}
                                <span class="mt-1 ms-2">{{ $pizza->links() }}</span>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                 <div class="mt-2 mb-2">
                                    <a href="{{route('admin#category')}}" class="text-dark fs-10">
                                        <i class="fas fa-arrow-left">Back</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
