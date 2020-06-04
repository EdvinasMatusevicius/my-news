@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            @isset($item->id)
                {{ __('Edit') }}
            @else
                {{ __('New') }}
            @endisset
            {{ __('Employee') }}
        </div>

        <form action="{{ route('admin.employee.'.(isset($item->id) ? 'update' : 'store'), isset($item->id) ? ['employee' => $item->id] : []) }}"
              method="POST">
            @csrf
            @isset($item->id)
                @method('put')
            @endisset

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="first_name">{{ __('fields.first_name') }}</label>
                        <input class="form-control @error('first_name') is-invalid @enderror"
                               type="text"
                               name="first_name"
                               id="first_name"
                               value="{{ old('first_name', $item->first_name ?? '') }}"
                        >
                        @error('first_name')
                        <div class="alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="last_name">{{ __('fields.last_name') }}</label>
                        <input class="form-control @error('last_name') is-invalid @enderror"
                               type="text"
                               name="last_name"
                               id="last_name"
                               value="{{ old('last_name', $item->last_name ?? '') }}"
                        >
                        @error('last_name')
                        <div class="alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">{{ __('fields.email') }}</label>
                    <input class="form-control @error('email') is-invalid @enderror"
                           type="text"
                           name="email"
                           id="email"
                           value="{{ old('email', $item->email ?? '') }}"
                    >
                    @error('email')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('fields.password') }}</label>
                    <input class="form-control @error('password') is-invalid @enderror"
                           type="password"
                           name="password"
                           id="password"
                           value=""
                    >
                    @error('password')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('fields.password_confirmation') }}</label>
                    <input class="form-control @error('password') is-invalid @enderror"
                           type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           value=""
                    >
                </div>
            </div>

            <div class="card-footer">
                <input class="btn btn-sm btn-primary" type="submit" value="{{ __('Save') }}">
            </div>

        </form>
    </div>
@endsection 