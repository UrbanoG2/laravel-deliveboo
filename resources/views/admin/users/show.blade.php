@extends('layouts.admin')

@section('content')
    <div class="container">
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
                <img src="{{ asset('storage/' . $user->logo_img) }}" alt="Ciao">
                <img src="{{ asset('storage/' . $user->banner_img) }}" alt="Hei">
            </div>
        </div>
    </div>
@endsection
