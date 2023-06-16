@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Entry/Exit</h2>
            </div>
            <div class="pull-right">
                @can('time-create')
                <a class="btn btn-success" href="{{ route('times.create') }}">Record Your Entry Here</a>
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
        <th>Date</th>
        <th>ID</th>
        <th>Name</th>
        <th>Entry Time</th>
        <th>Exit Time</th>
        <th>Missed Time</th>
        <th>IP</th>
        <th width="280px">Action</th>
    </tr>
@foreach ($data as $key => $time)
    <tr>
        <td>{{ $time->created_at->format('d/m/Y') }}</td>
        <td>{{ $time->user_id }}</td>
        <td>{{ $time->user }}</td>
        <td>{{ date('h:i:s a, d-F-Y', strtotime($time->entry)) }}</td>
        <td>{{ date('h:i:s a, d-F-Y', strtotime($time->exit)) }}</td>
        {{--<td>{{ gettype($time->entry) }}</td>
        <td>{{ gettype($time->exit) }}</td>--}}
        <td>{{ $time->missed }}</td>
        <td>{{ $time->ip }}</td>
        <td>
            {{--<a class="btn btn-info" href="{{ route('times.show',$time->id) }}">Approve</a>--}}
            @can('time-edit') {{-- time-edit working as time-approve --}}
            <a class="btn btn-primary" href="{{ route('times.edit', $time->id) }}">Record Exit</a>
            @endcan
            @can('time-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['times.destroy', $time->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
@endforeach
</table>
    {{--{!! $user->links() !!}--}}
@endsection