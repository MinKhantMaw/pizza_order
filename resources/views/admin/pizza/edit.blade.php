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
                                  <legend class="text-center">Edit Pizza </legend>
                              </div>

                              <div class="card-body">
                                  <div class="tab-content">
                                      <div class="mb-2">
                                          <img src="{{ asset('images/'. $pizza['image'])}}" style="width:130px;" alt="">
                                      </div>
                                      <div class="active tab-pane" id="activity">
                                          <form class="form-horizontal" method="post"
                                              action="{{ route('admin#updatePizza',$pizza['pizza_id']) }}" enctype="multipart/form-data">
                                              @csrf
                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control" name="name" value="{{old('name', $pizza['pizza_name'])}}"
                                                          placeholder="Enter Pizza Name">
                                                      @if ($errors->has('name'))
                                                          <p class="text-danger">{{ $errors->first('name') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                                                  <div class="col-sm-10">
                                                      <input type="file" class="form-control" name="image"
                                                          placeholder="Choose Image">
                                                      @if ($errors->has('image'))
                                                          <p class="text-danger">{{ $errors->first('image') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                                                  <div class="col-sm-10">
                                                      <input type="number" class="form-control" name="price" value="{{ old('price',$pizza->price)}}"
                                                          placeholder="Enter Pizza price">
                                                      @if ($errors->has('price'))
                                                          <p class="text-danger">{{ $errors->first('price') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Publish
                                                      Status</label>
                                                  <div class="col-sm-10">
                                                      <select name="publish" class="form-control">
                                                          <option value="">Choose</option>
                                                          @if ($pizza['publish_status']) ==1
                                                             <option value="1" selected>Publish</option>
                                                             <option value="0">Unpublish</option>
                                                             @else
                                                             <option value="1">Publish</option>
                                                             <option value="0" selected>UnPublish</option>
                                                          @endif
                                                      </select>
                                                      @if ($errors->has('publish'))
                                                          <p class="text-danger">{{ $errors->first('publish') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                                                  <div class="col-sm-10">
                                                      <select name="category" class="form-control">
                                                          <option value="{{$pizza['category_id']}}">{{$pizza['category_name']}}</option>
                                                            @foreach ($category as $item)
                                                                @if ($item['category_id'] != $pizza['category_id'])
                                                                 <option value="{{$item['category_id']}}">{{$item['category_name']}}</option>
                                                                @endif
                                                            @endforeach
                                                      </select>
                                                      @if ($errors->has('category'))
                                                          <p class="text-danger">{{ $errors->first('category') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                                                  <div class="col-sm-10">
                                                      <input type="number" class="form-control" name="discount" value="{{ old('discount',$pizza['discount_price'])}}"
                                                          placeholder="Discount">
                                                      @if ($errors->has('discount'))
                                                          <p class="text-danger">{{ $errors->first('discount') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                                                  <div class="col-sm-10 mt-2">
                                                    @if($pizza['buy_one_get_one_status']==1)
                                                        <input type="radio" class="form-input-check" name="buyOnegetOne" value="1" checked>Yes
                                                        <input type="radio" class="form-input-check" name="buyOnegetOne" value="0" >No

                                                    @elseif($pizza['buy_one_get_one_status']==0)
                                                        <input type="radio" class="form-input-check" name="buyOnegetOne" value="1" >Yes

                                                        <input type="radio" class="form-input-check" name="buyOnegetOne" value="0" checked>No
                                                    @endif
                                                
                                                      @if ($errors->has('buyOnegetOne'))
                                                          <p class="text-danger">{{ $errors->first('buyOnegetOne') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                                                  <div class="col-sm-10">
                                                      <input type="number" class="form-control" name="waitingTime" value="{{ old('waitingTime',$pizza['waiting_time'])}}"
                                                          placeholder="Waiting Time">
                                                      @if ($errors->has('waitingTime'))
                                                          <p class="text-danger">{{ $errors->first('waitingTime') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                                                  <div class="col-sm-10">
                                                     <textarea name="description" class="form-control" col="5" row="3" placeholder="Description">{{ old('description',$pizza['description'] ) }}</textarea>
                                                      @if ($errors->has('description'))
                                                          <p class="text-danger">{{ $errors->first('description') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <div class="offset-sm-2 col-sm-10">
                                                      <button type="submit" class="btn bg-dark text-white">Update</button>
                                                  </div>
                                              </div>
                                          </form>

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
