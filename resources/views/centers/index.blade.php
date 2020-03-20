@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Centers</h2>
            </div>
            <div class="pull-right">
                @can('center-create')
                    <a class="btn btn-success" href="{{ route('centers.create') }}"> Create New Center</a>
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
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($centers as $center)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $center->name }}</td>
                <td>{{ $center->address }}</td>
                <td>{{ $center->phone }}</td>
                <td>
                    <form action="{{ route('centers.destroy',$center->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('centers.show',$center->id) }}">Show</a>
                        @can('center-edit')
                            <a class="btn btn-primary" href="{{ route('centers.edit',$center->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('center-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $centers->links() !!}



@endsection