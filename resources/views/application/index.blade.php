@extends('layout')
@section('action-menu')
<a href="{{ URL::to('app/create') }}" class="list-group-item">New</a>
<a href="{{ URL::to('app/')}}" class="list-group-item">Admin</a>
@endsection
@section('content')
<div class="panel-heading"><h4>Admin applications</h4></div>

<div class="panel-body">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <table class="table">
        @foreach($apps as $p)
        <th>Nombre</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Operations</th>
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->customer->stand }}</td>
            @if ($p->status == 1)
            <td>Enable</td>
            @else
            <td>Disable</td>
            @endif
            <td>
                <div class="btn-group" role="group" aria-label="...">
                    <a href="{{ URL::to('app/view')."/".$p->id }}" class="btn btn-default">View</a>
                    <a href="{{ URL::to('app/edit')."/".$p->id }}" class="btn btn-default">Edit</a>
                    {!! Form::open(array('url' => 'app/' . $p->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button('Borrar', array('class' => 'btn btn-warning',
                    'data-target'=>'#confirmDelete','data-message'=>'Are you sure delete this application?','data-toggle'=>'modal')) !!}                   
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
        @endforeach
    </table> 
    @endsection
</div>
@endsection