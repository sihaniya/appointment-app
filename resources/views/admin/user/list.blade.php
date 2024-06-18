@extends('admin.layouts.base.master')
@section('content')
    <div class="be-page-header">
        <div class="be-page-title">
            <h4 class="mb-0">{{ $page_title }}</h4>
            @include('admin.layouts.partials.breadcrumb')
        </div>
        <div class="be-page-header-controls">
            <a href="{{ route('admin.user.create') }}" class="btn btn-icon btn-rounded btn-primary"><i class='bx bx-plus'></i> Add
                User</a>
        </div>
    </div>


    <div class="be-page-body">
        <div class="card app-card">
            <div class="card-body">
                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                <div class="table-responsive">
                    <table class="table app-table mb-0" id="user_table">
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-js')
    <script src="{{ asset('assets/js/admin/user.js?v=') }}{{ Config::get('app.version') }}"></script>
    <script>
        // Toast
        // $(document).on("click", ".confirm_toast", function(e) {
        //     e.preventDefault();
        //     toastr.success('Have fun storming the castle!', 'Miracle Max Says')
        // });

        var context = {};
        var cm = new user_manager();
        cm.fetch_list();
    </script>
@endpush
