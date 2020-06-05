@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-2">
            @include('front.account._partial.account_menu')
        </div>
        <div class="col-10">

            <div class="card">
                <div class="card-header">My account edit</div>

                <form action="{{ route('account.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                            <div class="alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-mail') }}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                            <div class="alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="old_password">{{ __('Old password') }}</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                   id="old_password" name="old_password" value="">
                            @error('old_password')
                            <div class="alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('New password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" value="">
                            @error('password')
                            <div class="alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Repeat new password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password_confirmation" name="password_confirmation" value="">
                        </div>

                    </div>

                    <div class="card-footer ">
                        <input type="submit" class="btn btn-sm btn-outline-primary" value="{{ __('Save') }}">
                        <a class="btn btn-sm btn-outline-dark float-right" href="{{ route('account.index') }}">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection 