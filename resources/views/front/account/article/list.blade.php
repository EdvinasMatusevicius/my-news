@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-2">
            @include('front.account._partial.account_menu')
        </div>

        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    My articles
                    <a class="btn btn-sm btn-outline-primary float-right" href="{{ route('account.article.create') }}">+</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Poster</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>

                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @isset($item->poster)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($item->poster) }}" width="100">
                                    @endisset
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('account.article.edit', ['article' => $item->id]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection