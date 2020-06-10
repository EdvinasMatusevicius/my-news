@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Article view') }}
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>

                @foreach($item->toArray() as $key => $value)

                    @if ($key == 'user_id')
                        @continue
                    @endif

                    <tr>
                        <td>{{ __('fields.'.$key) }}</td>
                        <td>
                            @switch($key)
                                @case('poster')
                                    @isset($value)
                                        <img src="{{ 
                                asset('/storage/'.$item->poster)
                                         }}" width="400">
                                    @endisset
                                    @break

                                @case('author')
                                    @isset($value)
                                        {{ $value['name'] }} < {{ $value['email'] }} >
                                    @endisset
                                @break

                                @default
                                    {{ $value }}
                            @endswitch

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a class="btn btn-sm btn-primary float-left mr-2"
               href="{{ route('admin.article.edit', ['article' => $item->id]) }}">Edit</a>
            <form class="float-left" action="{{ route('admin.article.destroy', ['article' => $item->id]) }}"
                  method="post">
                @csrf
                @method('delete')
                <input onclick="return confirm('Do you really want to delete a record?');"
                       class="btn btn-sm btn-danger" type="submit" value="Delete">
            </form>

            <a class="btn btn-sm btn-secondary float-right" href="{{ route('admin.article.index') }}">Cancel</a>
        </div>
    </div>
@endsection 