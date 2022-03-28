@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    Plates
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <a href="{{ route('admin.plates.create') }}" class="btn btn-dark mb-2">Add new plate</a>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plates as $plate)
                        <tr>
                            <td>{{ $plate->id }}</td>
                            <td>{{ $plate->name }}</td>
                            <td>{{ $plate->price }} &euro;</td>
                            <td>{{ $plate->visible }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.plates.show', $plate->slug) }}">View</a>
                                <a class="btn btn-primary" href="{{ route('admin.plates.edit', $plate->slug) }}">Edit</a>

                            </td>
                            <td>
                                <form action="{{ route('admin.plates.destroy', $plate->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input onclick="return confirm('Vuoi eliminare questo piatto?')" class="btn btn-danger"
                                        type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">{{ $plates->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
