@extends('base')

@section('title', 'Blog')

@section('content')
    <h1>{{ 'My blog' }}</h1>

    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>
            @if ($post->category)
                <p class="small">Catégorie: {{ $post->category?->name }}</p>
            @endif
            @if (!$post->tags->isEmpty())
                <p class="small">Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                </p>
            @endif
            @if ($post->image)
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid">
            @endif
            <p>
                {{ $post->content }}
            </p>
            <p>
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Read
                    more</a>
            </p>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection
