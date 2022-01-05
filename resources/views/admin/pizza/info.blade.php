@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-4">
                    <div class="col-11 offset-2 mt-5">
                        <div class="col-md-9">
                            <div class="mb-2 ">
                                <a href="{{ route('admin#pizza') }}" class="text-dark fs-10">
                                    <i class="fas fa-arrow-left">Back</i>
                                </a>
                            </div>
                           <div class="card">
                              <div class="card-header p-2">
                                  <legend class="text-center">Pizza Information</legend>
                              </div>

                              <div class="card-body">
                                  <div class="tab-content">
                                      <div class="active tab-pane " id="activity">
                                         <div class="text-center">
                                             <img src="{{asset('/images/'. $pizza['image'])}}" alt="" class="rounded-circle ">
                                         </div>
                                         <div>
                                             <b>Name</b>:
                                             <span>{{$pizza['pizza_name']}}</span>
                                         </div>
                                        <div>
                                             <b>Price</b>:
                                             <span>{{$pizza['price']}} Kyats</span>
                                         </div>
                                         <div>
                                             <b>Category</b>:
                                             <span>{{$pizza['category_id']}}</span>
                                         </div>
                                         <div>
                                             <b>Discount</b>:
                                             <span>{{$pizza['discount_price']}} Kyats</span>
                                         </div>
                                         <div>
                                             <b>Publish</b>:
                                             <span>@if ($pizza['publish_status']==1)
                                                 Publish
                                                 @else
                                                 Unpublish
                                             @endif</span>
                                         </div>
                                          <div>
                                             <b>Buy One Get One</b>:
                                             <span>@if ($pizza['buy_one_get_one_status']==1)
                                                 Yes
                                                 @else
                                                 No
                                             @endif</span>
                                         </div>
                                         <div>
                                             <b>Waiting Time</b>:
                                             <span>{{$pizza['waiting_time']}}</span>
                                         </div>
                                         <div>
                                             <b>Description</b>:
                                             <span>{{$pizza['description']}}</span>
                                         </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
