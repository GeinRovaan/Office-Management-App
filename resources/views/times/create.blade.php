@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Record Your Entry</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('times.index') }}">Back</a>
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
{!! Form::open(array('route' => 'times.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>ID:</strong>
            {{--<input type="text" class="form-control" name="user_id" value="{{ old('user_id', Auth::user()->id) }}" readonly>--}}
            {!! Form::text('user_id', null, array('placeholder' => $user->id, 'value' => $user->id, 'class' => 'form-control', 'readonly' => 'true')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{--<input type="text" class="form-control" name="user" value="{{ old('user', Auth::user()->name) }}" readonly>--}}
            {!! Form::text('user', null, array('placeholder' => $user->name, 'value' => $user->name, 'class' => 'form-control', 'readonly' => 'true')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Select:</strong>
            <br>
            <input type="radio" name="timeType" value="Entry"> Entry
            {{--<input type="radio" name="timeType" value="Exit"> Exit--}}
            {{--{!! Form::radio('timeType', null, array('value' => "Entry", 'class' => 'form-control')) !!} Entry
            {!! Form::radio('timeType', null, array('value' => "Exit", 'class' => 'form-control')) !!} Exit--}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection