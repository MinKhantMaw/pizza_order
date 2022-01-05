@extends('admin.layouts.app')
@section('content')
 <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-11 offset-2 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                 @if (Session::has('passwordnotmatch'))
                    <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('passwordnotmatch') }}
                        {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                 @if (Session::has('lengthError'))
                    <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('lengthError') }}
                        {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                 @if (Session::has('successChangePassword'))
                    <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('successChangePassword') }}
                        {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('oldpasserror'))
                    <div class="mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('oldpasserror') }}
                        {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <form class="form-horizontal" action="{{ route('admin#changePassword',Auth()->user()->id)}}" method="post">                            @csrf
                        <div class="form-group row">
                          <label for="inputName" class="">Old Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="oldPassword" value="" placeholder="">
                             @if ($errors->has('oldPassword'))
                                  <p class="text-danger">{{ $errors->first('oldPassword') }}</p>
                              @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="">New Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="newPassword" value="" placeholder="">
                             @if ($errors->has('newPassword'))
                                  <p class="text-danger">{{ $errors->first('newPassword') }}</p>
                              @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="">Confirm Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="confirmPassword" value="" placeholder="">
                             @if ($errors->has('confirmPassword'))
                                  <p class="text-danger">{{ $errors->first('confirmPassword') }}</p>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white float-right">Change Password</button>
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
{{--      </div>--}}
    </section>
  </div>
@endsection
