@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Articles') }}
            <a class="btn btn-sm btn-primary" href="{{ route('admin.article.create') }}">{{ __('+') }}</a>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('fields.poster') }}</th>
                    <th>{{ __('fields.title') }}</th>
                    <th>{{ __('fields.slug') }}</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->poster }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.article.edit', ['article' => $item->id]) }}">Edit</a>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.article.show', ['article' => $item->id]) }}">Show</a>
                            <form action="{{ route('admin.article.destroy', ['article' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <input onclick="return confirm('Do you really want to delete a record?');"
                                       class="btn btn-sm btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $items->links() }}
        </div>
    </div>
@endsection 