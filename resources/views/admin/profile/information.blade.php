<div class="card app-card">
    <div class="card-body">
        <h5 class="card-title mb-3">Profile information</h5>
        <form action="{{ route('admin.article.store') }}" id="createArticle" method="POST">
            @csrf()
            <div class="row">
                <div class="col-12 col-md-7 col-lg-7 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                        value="{{ $user->name }}" readonly>
                    @if ($errors->has('name'))
                        <div class="form-error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7 col-lg-7 mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="email" id="email"
                        placeholder="Email Address"value="{{ $user->email }}" readonly>
                    @if ($errors->has('email'))
                        <div class="form-error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
