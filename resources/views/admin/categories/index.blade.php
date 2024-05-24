@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<div class="container me-5">
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row mb-4">
            <div class="col-3">
                <input type="text" name="name" class="form-control" placeholder="Add a category...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</button>
            </div>
            @error('name')
                <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>
    <table class="table border table-hover bg-white align-middle text-secondary table-sm">
        <thead class="text-secondary table-warning text-uppercase small">
            <tr>
                <th>&nbsp;#</th>
                <th>Name</th>
                <th>Count</th>
                <th>Last Update</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($all_categories as $category)
                <tr>
                    <td>
                        {{-- category id --}}
                        &nbsp;{{ $category->id }}
                    </td>
                    <td>
                        {{-- category name --}}
                        {{ $category->name }}
                    </td>
                    <td>
                        {{-- count --}}
                        {{ $category->categoryPosts->count() }}
                    </td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        {{-- button --}}
                        <button type="submit" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit-category{{ $category->id }}"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category{{ $category->id }}"><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
                @include('admin.categories.actions')
            @empty 
                <tr>
                    <td colspan="5">No categories found.</td>
                </tr>
            @endforelse 
            <tr>
                <td>&nbsp;0</td>
                <td>Uncategorized</td>
                <td>{{ $uncategorized_count }}</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection