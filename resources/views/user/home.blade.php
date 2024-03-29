@extends('user.layout.style')
@section('content')
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light" id="about">CODE LAB Pizza</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it,
                    but it makes a great use of the standard Bootstrap core components. Feel free to use this template
                    for any project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex justify-content-around">
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-5 text-center">
                        <form class="d-flex m-5">
                            <div class="input-group">
                                <input class="form-control " placeholder="Search" aria-label="Search">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div class="">
                            <div class="m-2 p-2">All</div>
                            <div class="m-2 p-2">Seafood</div>
                            <div class="m-2 p-2">Chicken</div>
                            <div class="m-2 p-2">Cheese</div>
                            <div class="m-2 p-2">BBQ</div>
                            <div class="m-2 p-2">Ocean</div>
                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Start Date - End Date</h3>

                            <form>
                                <input type="date" name="" id="" class="form-control"> -
                                <input type="date" name="" id="" class="form-control">
                            </form>
                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Min - Max Amount</h3>

                            <form>
                                <input type="number" name="" id="" class="form-control" placeholder="minimum price"> -
                                <input type="number" name="" id="" class="form-control" placeholder="maximun price">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row gx-4 gx-lg-5">
                    @foreach ($pizza as $item)
                        <div class="col-md-4 mb-5" id="pizza">
                            <div class="card h-70">
                                <!-- Sale badge-->

                                @if ($item->buy_one_get_one_status == 1)
                                    <div class="badge bg-danger text-white position-absolute"
                                        style="top: 0.1rem; right: 0.1rem">
                                        Buy 1 get 1</div>
                                @endif

                                <!-- Product image-->
                                <img class="card-img-top" id="pizza-img" src="{{ asset('images/' . $item->image) }}"
                                    height="150px" width="200px" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $item['pizza_name'] }}</h5>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">$20.00</span>
                                        {{ $item->price }} Kyates
                                    </div>
                                    <div class="text-center">
                                        <b>Waiting Time {{ $item->waiting_time }} minutes</b>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                                            cart</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="text-center d-flex justify-content-center align-items-center" id="contact">
        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
            <h3>Contact Us</h3>

            <form action="{{route('user#contactCreate')}}" method="post" class="my-4">
                @csrf
                <input type="text" name="name" value="{{old('name')}}" class="form-control my-3" placeholder="Name">
                <input type="text" name="email" value="{{old('email')}}" class="form-control my-3" placeholder="Email">
                <textarea class="form-control my-3" name="message" value="{{old('message')}}" rows="3"
                    placeholder="Message"></textarea>
                <button type="submit" class="btn btn-outline-dark">Send <i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>

        <div class="card-footer text-center bg-dark text-white">
            developer
        </div>
@endsection
