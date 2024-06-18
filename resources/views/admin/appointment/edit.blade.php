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
                <form id="appointmentForm" action="{{ route('admin.appointment.update', ['id' => $id]) }}" method="POST">
                    @csrf()
                    <div class="col-12 col-md-6 col-lg-6">

                        <div class=" mb-3">
                            <label for="user" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="">Select User</option>

                                @foreach ($user as $User)
                                    <option value="{{ $User->id }}" @if ($User->id === $appointment->user_id) selected @endif>{{ $User->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <div class="form-error">{{ $errors->first('user_id') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Appointment Date</label>
                            <input value="{{ $appointment->appointment_date }}" type="date" class="form-control" name="appointment_date" id="appointment_date">
                            @if ($errors->has('appointment_date'))
                                <div class="form-error">{{ $errors->first('appointment_date') }}</div>
                            @endif
                        </div>
                        <div class=" mb-3">
                            <select name="status" id="status" class="form-select">
                                <option value="0" @if ($appointment->status === 0) selectd @endif>No</option>
                                <option value="1" @if ($appointment->status === 1) selectd @endif>Yes</option>
                            </select>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-1">Save</button>
                            <a href="{{ route('admin.appointment') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-js')
    <script src="{{ asset('assets/js/admin/appointment.js?v=') }}{{ Config::get('app.version') }}"></script>
    <script>
        // Toast
        // $(document).on("click", ".confirm_toast", function(e) {
        //     e.preventDefault();
        //     toastr.success('Have fun storming the castle!', 'Miracle Max Says')
        // });

        var context = {};
        // var cm = new category_manager();
    </script>
@endpush
