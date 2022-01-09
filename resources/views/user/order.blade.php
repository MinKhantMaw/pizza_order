@extends('user.layout.style')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('images/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{ route('user#pizzaDetails', $pizza->pizza_id) }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
             @if (Session::has('totalTime'))
                <div class="mt-2 alert alert-info alert-dismissible fade show" role="alert">
                  Order Success ! Please Wait  {{ Session::get('totalTime') }} Minutes
                    {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h5>Name</h5>
            <span class="text-primary">{{ $pizza->pizza_name }}</span>
            <hr>
            <h5>Price</h5>
            <span class="text-primary">{{ $pizza['price'] - $pizza['discount_price'] }} <small
                    class="text-dark fs-4">kyats</small></span>
            <hr>
            <h5>Waiting Time</h5>
            <span class="text-primary">{{ $pizza->waiting_time }} <small class="text-dark fs-5">Minutes </small> </span>
            <hr>
            <form action="{{ route('user#orderPage') }}" method="post">
                @csrf
                <h5>Pizza Count</h5>
                <input type="number" name="pizzaCount" class="form-control" max="10" min="0">
                @if ($errors->has('pizzaCount'))
                    <span class="text-danger">{{ $errors->first('pizzaCount') }}</span>
                @endif
                <hr>
                <h5>Payment Method</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Credit Card</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">Cash</label>
                </div>
                @if ($errors->has('pizzaCount'))
                    <span class="text-danger">{{ $errors->first('payment') }}</span>
                @endif
                <br>
                <button class="btn btn-primary  mt-2 " type="submit">
                    <i class="fas fa-shopping-cart"></i>PlaceOrder
                </button>
            </form>
            <hr>
        </div>
    </div>
@endsection
