@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mt-1">
                                    <span class="text-secondary">Total Contact - <b>{{$contact->total()}}</b> </span>
                                </h3>

                                <div class="card-tools">
                                    <form action="{{ route('admin#contactSearch') }}" method="get">
                                        @csrf
                                        <div class="input-group input-group-sm " style="width: 150px;">
                                            <input type="text" name="searchData"
                                                class="form-control float-right" placeholder="Search">

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
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Customer Message</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contact as $list)
                                            <tr>
                                                <td>{{ $list->contact_id }}</td>
                                                <td>{{ $list->name }}</td>
                                                 <td>{{ $list->email }}</td>
                                                 <td>{{ $list->message }}</td>
                                                {{-- <td>
                                                    @if ($item->count==0)
                                                        <a href="#" class="text-decoration-none">{{$item->count}}</a>
                                                    @else
                                                        <a href="{{ route('admin#categoryItem', $item->category_id) }} " class="text-decoration-none">{{$item->count}}</a>
                                                    @endif
                                                </td> --}}
                                                {{-- <td>
                                                    <a href="{{ route('admin#edit', $item->category_id) }}">
                                                        <button class="btn btn-sm bg-dark text-white"><i
                                                                class="fas fa-edit"></i></button>
                                                    </a>
                                                    <a href="{{ route('admin#delete', $item->category_id) }}">
                                                        <button class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- @if ($status==0)
                                        <tr>
                                            <td colspan="4 ">
                                                <small class="text-danger">You have no contacts.</small>
                                            </td>
                                        </tr>
                                    @endif --}}
                                </table>
                                {{-- pagination --}}
                                <span class="mt-1 ms-2">{{ $contact->links() }}</span>
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
