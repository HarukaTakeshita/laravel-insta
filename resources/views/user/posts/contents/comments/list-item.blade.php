<div class="mb-2">
    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
    &nbsp;
    <span class="fw-light">{{ $comment->body }}</span>
    <div class="text-muted small">
        <span>{{ date("D, M d Y", strtotime($comment->created_at)) }}</span>
        @if ($comment->user->id == Auth::user()->id )
        &middot;
        <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-danger bg-transparent border-0 shadow-none p-0">Delete</button>
        </form>
    @endif
    </div>
</div>