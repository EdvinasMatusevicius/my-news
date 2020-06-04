@extends('layouts.admin')

@section('content')
<div class="card">
<div class="card-header">
    {{__('Employees')}}
<a class="btn btn-sm btn-primary" href="{{route('admin.employee.create')}}">{{__('+')}}</a>

</div>

    <div class="card-body">
       <table class='table'>
           <thead>
               <tr>
                   <td>#</td>
                   <td>{{__('fields.first_name')}}</td>
                   <td>{{__('fields.last_name')}}</td>
                   <td>E-mail</td>
                   <td>Actions</td>
               </tr>
           </thead>
           <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('admin.employee.edit',['employee'=>$item->id])}}">Edit</a>
                            <a class="btn btn-sm btn-success" href="{{route('admin.employee.show',['employee'=>$item->id])}}">Show</a>
                            <form action="{{route('admin.employee.destroy',['employee'=>$item->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                <input onclick = return
                                class = "btn btn-sm btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
           </tbody>
       </table>
    </div>
    <div class="card-footer">
        {{$items->links()}}
    </div>
</div>
@endsection