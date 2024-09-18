@extends('base')

@section('title', 'Edit an article')

@section('content')
    <form action="{{ $post->id ? route('blog.update', $post) : route('blog.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @if ($post->id)
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @error('image')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category?->id) === $category->id) value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        @php
            $tagsIds = $post->tags->pluck('id');
        @endphp
        <div class="mb-3">
            <label for="tag" class="form-label">tag</label>
            <select class="form-select" name="tags[]" multiple>
                <option value="">Select one or several tags</option>
                @foreach ($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">
                        {{ $tag->name }}
                @endforeach
            </select>
            @error('tag')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            @if ($post->id)
                {{ __('Update') }}
            @else
                {{ __('Create') }}
            @endif
        </button>
    </form>
@endsection
