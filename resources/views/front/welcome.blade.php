@extends('layouts.app')

@section('content')
       
<div class="card">
    <div class="card-header">Newest</div>

    <div class="card-body">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-2 p-2">
                    <h4 class="">
                        <a class="card-link" href="{{ route('article.show', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
                    </h4>
                    <div class="">
                        @isset($article->author)
                            <p class="float-left">{{ $article->author->name }}</p>
                        @endisset
                        <em class="float-right">{{ $article->created_at->format('Y-m-d H:i') }}</em>
                    </div>
                    <div class="">
                        @isset($article->poster)
                            <img class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($article->poster) }}">
                        @endisset
                    </div>
                    <div class="">
                        {{ \Illuminate\Support\Str::limit($article->content, 200, ' ...') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card-footer m-auto">
        {{ $articles->links() }}
    </div>
</div>
    @endsection
