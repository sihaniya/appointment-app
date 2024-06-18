@extends('admin.layouts.base.master')

@section('content')
    <div class="be-page-header">
        <div class="be-page-title">
            <h4 class="mb-0">{{ $page_title }}</h4>
            @include('admin.layouts.partials.breadcrumb')
        </div>
    </div>


    <div class="be-page-body">
        <div class="card app-card">
            <div class="card-body">
                <form action="{{ route('admin.user.update', ['id' => $id]) }}" method="POST">
                    @csrf()
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <label for="name" class="form-label">User</label>
                            <input value="{{ $user->name }}" type="text" class="form-control slug-generator" name="name" id="name" placeholder="User">
                            @if ($errors->has('name'))
                                <div class="form-error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="{{ $user->role }}">{{ $user->role }}</option>
                                <option value="Author">Author</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value ="{{ $user->email }}" class="form-control" name="email" id="email" placeholder="Email Address">
                            @if ($errors->has('email'))
                                <div class="form-error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                            <label for="phone" class="form-label">Mobile Number</label>
                            <input type="text" value="{{ $user->phone }}" class="form-control" name="phone" id="phone" placeholder="Mobile Number">
                        </div>
                    </div>
                    <input type="hidden" value="{{ $user->password }}" class="form-control" name="password" id="password">
                    <div>
                        <button type="submit" class="btn btn-primary me-1">Save</button>
                        <a href="{{ route('admin.user') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-js')
    {{-- <script src="{{ asset('assets/js/admin/category.js?v=') }}{{ Config::get('app.version') }}"></script> --}}
    <script>
        // Toast
        // $(document).on("click", ".confirm_toast", function(e) {
        //     e.preventDefault();
        //     toastr.success('Have fun storming the castle!', 'Miracle Max Says')
        // });

        // var context = {};
        // var cm = new category_manager();
    </script>
@endpush
