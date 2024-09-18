@extends('base')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        @if ($post->image)
            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid">
        @endif
    </article>
@endsection
