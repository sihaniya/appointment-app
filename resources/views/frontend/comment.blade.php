<h4 class="app-h4 mt-4 mb-3">Comments:</h4>
<div class="card app-card">
    <div class="card-body">
        <form action="{{ route('comment.save', ['id' => $article->id]) }}" id="commentForm" method="POST">
            @csrf()
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Email Address">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="3" name="message" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class='bx bx-loader bx-spin'
                            id="commentFormLoader" style="display: none;"></i>
                        Submit</button>
                </div>
            </div>
        </form>
        <div class="fe-comments" id="displayComments"></div>
    </div>
</div>
