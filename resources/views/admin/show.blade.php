@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Employee view') }}
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
                <tr>
                    <td>{{ __('fields.'.$key) }}</td>
                    <td>{{ $value }}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a class="btn btn-sm btn-primary float-left mr-2" href="{{ route('admin.employee.edit', ['employee' => $item->id]) }}">Edit</a>
            <form class="float-left" action="{{ route('admin.employee.destroy', ['employee' => $item->id]) }}" method="post">
                @csrf
                @method('delete')
                <input onclick="return confirm('Do you really want to delete a record?');"
                       class="btn btn-sm btn-danger" type="submit" value="Delete">
            </form>

            <a class="btn btn-sm btn-secondary float-right" href="{{ route('admin.employee.index') }}">Cancel</a>
        </div>
    </div>
@endsection 