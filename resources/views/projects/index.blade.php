@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Projects</h2>
            </div>
            <div class="pull-right">
                @can('project-create')
                <a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Project</a>
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
    <br>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Assigned To</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($projects as $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->name }}</td>
            <td>
            @if(!empty($users))
                @foreach($users as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
            @endif
            </td>
            <td>{{ $project->detail }}</td>
            <td>
                <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">Show</a>
                    @can('project-edit')
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('project-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $projects->links() !!}
@endsection