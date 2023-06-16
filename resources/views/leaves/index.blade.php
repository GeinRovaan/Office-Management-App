@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Leave</h2>
            </div>
            <div class="pull-right">
                @can('leave-create')
                <a class="btn btn-success" href="{{ route('leaves.create') }}">Ask for a Leave</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <br>
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
    <br>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Reason</th>
        <th>Requested At</th>
        <th>Requested For</th>
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>
@foreach ($data as $key => $leave)
    <tr>
        <td>{{ $leave->user_id }}</td>
        <td>{{ $leave->user }}</td>
        <td>{{ $leave->detail}}</td>
        <td>{{ $leave->created_at->format('l, h:i:s a, d-F-Y') }}</td>
        <td>{{ date('l, d-F-Y', strtotime($leave->req_time)) }}</td>
        <td>{{ $leave->status }}</td>
        <td>
            {{--<a class="btn btn-info" href="{{ route('leaves.show',$leave->id) }}">Approve</a>--}}
            @can('leave-edit') {{-- leave-edit working as leave-approve --}}
            <a class="btn btn-primary" href="{{ route('leaves.edit', $leave->id) }}">Approve</a>
            @endcan
            @can('leave-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['leaves.destroy', $leave->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
@endforeach
</table>
    {{--{!! $user->links() !!}--}}
@endsection