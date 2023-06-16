@extends('layouts.app')
@section('content')
    <div class="row">
    {{-- Working as Recording Exit Time --}}
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Record Your Exit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('times.index') }}"> Back</a>
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
    {!! Form::model($time, ['method' => 'PATCH','route' => ['times.update', $time->id]]) !!}
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID:</strong>
                    {!! Form::text('user_id', null, array('placeholder' => $time->user_id,'class' => 'form-control', 'readonly' => 'true')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('user', null, array('placeholder' => $time->user,'class' => 'form-control', 'readonly' => 'true')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Entry Time:</strong>
                    {!! Form::text('entry', null, array('placeholder' => $time->entry, 'class' => 'form-control', 'readonly' => 'true')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <br>
                    <strong>Select:</strong>
                    <br>
                    <input type="radio" name="timeType" value="Exit"> Exit
                    {{-- req_time is actually the day requested for & requested at is generated from created at --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-success">Approve</button>
            </div>
        </div>
    {!! Form::close() !!}
@endsection