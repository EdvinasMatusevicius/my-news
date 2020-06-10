@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            @isset($item->id)
                {{ __('Edit') }}
            @else
                {{ __('New') }}
            @endisset
            {{ __('Article') }}
        </div>

        <form action="{{ route('admin.article.'.(isset($item->id) ? 'update' : 'store'), isset($item->id) ? ['article' => $item->id] : []) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @isset($item->id)
                @method('put')
            @endisset

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="title">{{ __('fields.title') }}</label>
                        <input class="form-control @error('title') is-invalid @enderror"
                               type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $item->title ?? '') }}"
                        >
                        @error('title')
                        <div class="alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="slug">{{ __('fields.slug') }}</label>
                        <input class="form-control @error('slug') is-invalid @enderror"
                               type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $item->slug ?? '') }}"
                        >
                        @error('slug')
                        <div class="alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="poster">{{ __('fields.poster') }}</label>

                    @isset($item->poster)
                        <img src="{{ asset('/storage/'.$item->poster) }}" width="200">
                    @endisset

                    <input class="@error('poster') is-invalid @enderror"
                           type="file"
                           name="poster"
                           id="poster"
                           value=""
                    >
                    @error('poster')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">{{ __('Content') }}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              name="content"
                              id="content"
                    >{{ old('content', $item->content ?? '') }}</textarea>
                    @error('content')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="user_id">{{ __('fields.author') }}</label>
                    <select class="form-control @error('user_id') is-invalid @enderror"
                            name="user_id"
                            id="user_id">
                        <option value="">---</option>

                        @foreach($authors as $authorId => $author)
                            <option value="{{ $authorId }}" @if(isset($item->user_id) && $item->user_id == $authorId) selected @endif>{{ $author }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="active">{{ __('Active') }}</label>
                    <input class="form-check @error('active') is-invalid @enderror"
                           type="checkbox"
                           name="active"
                           id="active"
                           value="1"
                           @if(old('active', $item->active ?? null)) checked @endif
                    >
                </div>
            </div>

            <div class="card-footer">
                <input class="btn btn-sm btn-primary" type="submit" value="{{ __('Save') }}">
            </div>

        </form>
    </div>
@endsection