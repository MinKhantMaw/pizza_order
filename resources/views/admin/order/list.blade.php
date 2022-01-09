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
                                <span class="ml-5"> Order List - <b>{{$order->total()}} </b></span>
                                <div class="card-tools ">
                                    <form action="{{route('admin#orderSearch')}}" method="get">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">

                                            <input type="text" name="searchData" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
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
                                            <th>Pizza Name</th>
                                            <th>Pizza Count</th>
                                            <th>Order Time</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($status == 0)
                                            <tr style="font-size:20px">
                                                <td colspan="7" class="text-danger">You have no data</td>
                                            </tr>
                                        @else --}}
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{$item->order_id}}</td>
                                                    <td>{{ $item['customer_name'] }}</td>
                                                    <td>{{ $item['pizza_name'] }}</td>
                                                    <td>{{$item['count']}}</td>
                                                    <td>{{$item['order_time']}}</td>
                                                    {{-- <td>{{$item ['payment_status'] }}</td> --}}
                                                    {{-- <td>{{$item['carrier_id']}}</td> --}}
                                                    {{-- <td>
                                                        <img src="{{ asset('images/' . $item['image']) }}"
                                                            class="img-thumbnail" width="100px">
                                                    </td> --}}
                                                    {{-- <td>{{ $item['price'] }} kyats</td> --}}
                                                    {{-- <td>
                                                        @if ($item['publish_status'] == 1)
                                                            Publish
                                                        @elseif ($item['publish_status'] ==0)
                                                            Unpublish
                                                        @endif
                                                    </td> --}}
                                                    {{-- <td>
                                                        @if ($item['buy_one_get_one_status'] == 1)
                                                            Yes
                                                        @elseif ($item['buy_one_get_one_status'] ==0)
                                                            No
                                                        @endif
                                                    </td> --}}

                                                </tr>
                                            @endforeach
                                        {{-- @endif --}}
                                    </tbody>
                                </table>
                                <div>
                                    <span class="mt-1 ms-2">{{ $order->links() }}</span>
                                </div>
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
    <!-- /.content-wrapper -->
@endsection
