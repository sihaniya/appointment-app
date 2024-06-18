@extends('admin.layouts.auth.default')

@section('content')
    <div class="be-card-form">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title mb-2">Welcome! User</h5>
                <h6 class="card-subtitle mb-5 text-body-secondary">Login Your Account</h6>
                <form class="be-card-form-inner" method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email Address <span>*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" />
                        {!! $errors->first('email', '<div class="form-error">:message</div>') !!}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <span>*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        {!! $errors->first('password', '<div class="form-error">:message</div>') !!}
                    </div>
                    <div class="mb-3">
                        <a href="http://">Forget Password</a>
                    </div>
                    <div class="mb-3 d-flex justify-content space-between">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
