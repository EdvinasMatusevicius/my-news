@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $article->title }}</div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div>
                        @isset($article->author)
                            <p class="float-left">{{ $article->author->name }}</p>
                        @endisset
                        <em class="float-right">{{ $article->created_at->format('Y-m-d H:i') }}</em>
                    </div>

                    @isset($article->poster)
                    <div>
                        <img class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($article->poster) }}">
                    </div>
                    @endisset

                    <div>
                        <p>{{ $article->content }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection 