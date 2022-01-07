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
                                  <legend class="text-center">Add Pizza </legend>
                              </div>

                              <div class="card-body">
                                  <div class="tab-content">
                                      <div class="active tab-pane" id="activity">
                                          <form class="form-horizontal" method="post"
                                              action="{{ route('admin#insertPizza') }}" enctype="multipart/form-data">
                                              @csrf
                                              <div class="form-group row">
                                                  <label for="inputName"  class="col-sm-2 col-form-label">Name</label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control" name="name"
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
                                                      <input type="number" class="form-control" name="price"
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
                                                          <option value="1">Publish</option>
                                                          <option value="0">Unpublish</option>
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
                                                          <option value="">Choose Category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{$item['category_id']}}">{{$item['category_name']}}</option>
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
                                                      <input type="number" class="form-control" name="discount"
                                                          placeholder="Discount">
                                                      @if ($errors->has('discount'))
                                                          <p class="text-danger">{{ $errors->first('discount') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                                                  <div class="col-sm-10 mt-2">
                                                      <input type="radio" name="buyOnegetOne" class="form-input-check" value="1"> Yes
                                                      <input type="radio" name="buyOnegetOne" class="form-input-check" value="0"> No
                                                      @if ($errors->has('buyOnegetOne'))
                                                          <p class="text-danger">{{ $errors->first('buyOnegetOne') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                                                  <div class="col-sm-10">
                                                      <input type="number" class="form-control" name="waitingTime"
                                                          placeholder="Waiting Time">
                                                      @if ($errors->has('waitingTime'))
                                                          <p class="text-danger">{{ $errors->first('waitingTime') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                                                  <div class="col-sm-10">
                                                     <textarea name="description" class="form-control" col="5" row="3" placeholder="Description"></textarea>
                                                      @if ($errors->has('description'))
                                                          <p class="text-danger">{{ $errors->first('description') }}</p>
                                                      @endif
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <div class="offset-sm-2 col-sm-10">
                                                      <button type="submit" class="btn bg-dark text-white">Submit</button>
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
