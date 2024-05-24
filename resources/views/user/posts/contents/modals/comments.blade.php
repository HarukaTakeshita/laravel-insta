<style>
    .modal-body{
        overflow-y: scroll;
        height: 350px;
    }
</style>

<div class="modal fade" id="recent-comment{{ $user->id }}">
    <div class="modal-dialog bg-white border-secondary">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h4 class="h5 text-secondary">Recent Comments</h4>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-auto w-100">
                        @foreach ($user->comments->take(5) as $comment)
                        <div class="card border-primary mb-2">
                            <div class="card-body">
                                <h6>{{ $comment->body }}</h6>
                                <hr>
                                <span class="text-muted small">Repiled to <a href="{{ route('post.show', $comment->post->id) }}" class="text-decoration-none">{{ $comment->post->user->name }}'s post</a></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer border-none">
                <button type="button" data-bs-dismiss="modal" class="btn ms-auto btn-outline-secondary">Close</button>
            </div>
        </div>
    </div>
</div>