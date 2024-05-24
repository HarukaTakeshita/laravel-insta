@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

<div class="container me-5">
    {{-- SEARCH --}}
    <div class="row mb-3">
        <div class="col-10"></div>
        <div class="col-2">
            @auth
                <form action="{{ route('admin.posts') }}" method="get"> 
                    <input type="search" name="search" placeholder="search posts..." class="form-control" value="{{ request()->get('search') }}">
                </form>
            @endauth
        </div>
    </div>
    <table class="table border table-hover bg-white align-middle text-secondary">
        <thead class="text-secondary table-primary text-uppercase small">
            <tr>
                <th></th>
                <th></th>
                <th>Category</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($all_posts as $post)
                <tr>
                    <td>
                        {{-- post id --}}
                        &nbsp;{{ $post->id }}
                    </td>
                    <td>
                        {{-- image --}}
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="" class="image-lg">
                        </a>
                    </td>
                    <td>
                        {{-- categories --}}
                        @forelse ($post->categoryPosts as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">
                                {{ $category_post->category->name }}
                            </div>
                        @empty
                            <div class="badge bg-dark">Uncategorized</div>
                        @endforelse
                    </td>
                    <td>
                        {{-- owner --}}
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-dark text-decoration-none">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        {{-- status --}}
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        @if($post->user->id != Auth::user()->id)
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            @if(!$post->trashed())
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                                    </button>
                                </div>
                            @else
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> Show Post {{ $post->id }}
                                    </button>
                                </div>
                            @endif
                            @include('admin.posts.actions')
                        </div>
                        @endif
                    </td>
                </tr>
            @empty 
                <tr>
                    <td class="text-center" colspan="6">No posts found.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
</div>
@endsection