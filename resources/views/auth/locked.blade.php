@extends('template.layout2')
@section('title', 'Lock')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-5">
        <div class="container">
          <div class="header-body text-center mb-5">
            <div class="row justify-content-center">
              <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h1 class="text-white">Lock screen</h1>
                <p class="text-lead text-white">Better to be safe than sorry.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </div>
      <!-- Page content -->
      <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-7">
            <div class="card card-profile bg-secondary mt-5">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <img src="../../assets/img/theme/team-5.jpg" class="rounded-circle border-secondary">
                  </div>
                </div>
              </div>
              <div class="card-body pt-7 px-5">
                <div class="text-center mb-4">
                  <h3>{{ ucfirst(Auth::user()->name) }}</h3>
                </div>
                <form role="form" method="POST" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">
                  @csrf
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" type="password" name="password" required>
                      @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2">{{ __('Unlock') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection


@push('styles')
    
@endpush

@push('scripts')
    
@endpush