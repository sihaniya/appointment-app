<div class="card app-card mt-3">
    <div class="card-body">
        <h5 class="card-title mb-3">Change Password</h5>
        <form action="{{ route('admin.profile.changePassword') }}" id="changePassword" method="POST">
            @csrf()
            <div class="row">
                <div class="col-12 col-md-7 col-lg-7 mb-3">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="old_password"
                        placeholder="Old Password">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7 col-lg-7 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary me-1">Save</button>
                <a href="{{ route('admin.category') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
