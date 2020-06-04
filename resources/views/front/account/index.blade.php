@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">My account</div>

                <div class="card-body">
                   
                    <table class="table">
                        <tr>
                            <td>{{__('E-mail')}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Registerd from')}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                <a href="" class="btn btn-sm btn-outline-primary">{{__('Edit')}}</a>
                </div>
</div>
@endsection
