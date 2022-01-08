@extends('user.layout.style')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('images/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
            <a href="{{ route('user#index') }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            <h5>Name</h5>
            <span class="text-primary">{{ $pizza->pizza_name }}</span>
            <hr>
            <h5>Price</h5>
            <span class="text-primary">{{ $pizza->price }} <small class="text-dark fs-4">kyats</small></span>
            <hr>
            <h5>Discount</h5>
            <span class="text-primary">{{ $pizza->discount_price }} <small class="text-dark fs-4">kyats</small></span>
            <hr>
            <h5 >Buy 1 get 1</h5>
            @if ($pizza->buy_one_get_one_status == 1)
               <span class="text-primary"> This item is available.</span>
            @elseif ($pizza->buy_one_get_one_status==0)
               <span class="text-primary"> This item is not available.</span>
            @endif
            <hr>
            <h5>Waiting Time</h5>
            <span class="text-primary">{{ $pizza->waiting_time }} <small class="text-dark fs-5">Minutes </small> </span>
            <hr>
            <h5>Description</h5>
            <span class="text-primary">{{ $pizza->description }} </span>
            <hr>
            <h5 class="text-danger">Total Price</h5>
            <span class="text-danger">{{$pizza['price']-$pizza['discount_price']}}</span>
            <hr>
        </div>
    </div>
@endsection
