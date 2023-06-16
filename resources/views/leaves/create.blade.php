@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ask for a Leave</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('leaves.index') }}">Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
{!! Form::open(array('route' => 'leaves.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID:</strong>
            {{--<input type="text" class="form-control" name="user_id" value="{{ old('user_id', Auth::user()->id) }}" readonly>--}}
            {!! Form::text('user_id', null, array('placeholder' => $leave->id, 'value' => $leave->id, 'class' => 'form-control', 'readonly' => 'true')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{--<input type="text" class="form-control" name="user" value="{{ old('user', Auth::user()->name) }}" readonly>--}}
            {!! Form::text('user', null, array('placeholder' => $leave->name, 'value' => $leave->name, 'class' => 'form-control', 'readonly' => 'true')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            {!! Form::text('detail', null, array('placeholder' => 'Details','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date:</strong>
            {!! Form::date('req_time', null, array('class' => 'form-control')) !!}
            {{-- req_time is actually the day requested for & requested at is generated from created at --}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection