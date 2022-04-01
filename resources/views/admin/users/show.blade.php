@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    {{ $user->name }}
                </h1>
                <p>
                    {{ $user->address }}
                </p>
                <h2>
                    {{ $user->iva }}
                </h2>
            </div>
        </div>
    </div>
@endsection
