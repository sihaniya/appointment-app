@extends('admin.layouts.base.master')

@section('content')
    <div class="be-page-header">
        <div class="be-page-title">
            <h4 class="mb-0">{{ $page_title }}</h4>
            @include('admin.layouts.partials.breadcrumb')
        </div>
    </div>

    <div class="be-page-body">
        <div class="row">
            <div class="col-12 col-md-3 mb-3">
                <div class="card app-card">
                    <div class="card-body gap-3 d-flex flex-column align-items-center">

                        @if (empty(auth()->user()->profile_image))
                            <img src="{{ asset('assets/media/avatars/blank.png') }}" class="img-thumbnail"
                                alt="profile picture">
                        @else
                            <img src="{{ url($user->profile_image) }}" class="img-thumbnail" alt="profile picture">
                        @endif


                        <form action="{{ route('admin.profile.updateProfileImage') }}" id="update_profile_image">
                            <label for="profile_image" class="btn btn-primary">Upload
                                Picture</label>
                            <input type="file" class="d-none" id="profile_image">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                @include('admin.profile.information')
                @include('admin.profile.change-password')
            </div>
        </div>
    </div>
@endsection

@push('after-js')
    <script src="{{ asset('assets/js/admin/profile.js?v=') }}{{ Config::get('app.version') }}"></script>
    <script>
        var context = {};
        context.upload_url = '{!! route('admin.profile.updateProfileImage') !!}';
        var cm = new profile_manager(context);
    </script>
@endpush
