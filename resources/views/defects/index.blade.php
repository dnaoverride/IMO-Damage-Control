@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Defects</h2>
            </div>
            <div class="pull-right">
                @can('center-create')
                    <a class="btn btn-success" href="{{ route('defects.create') }}"> Report New Defect</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Description</th>
            <th>Priority</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($defects as $defect)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $defect->name }}</td>
                <td>{{ $defect->priority }}</td>
                <td>
                    <form action="{{ route('defects.destroy',$defect->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('defects.show',$defect->id) }}">Show</a>
                        @can('defect-edit')
                            <a class="btn btn-primary" href="{{ route('defects.edit',$defect->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('defect-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $defects->links() !!}



@endsection