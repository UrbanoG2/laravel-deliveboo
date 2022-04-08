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
                    {{ $order->totalPrice }} &euro;
                </h1>
                <p>
                    Ordine creato il: {{ $order->created_at }}
                </p>
<<<<<<< HEAD
                <ul>
                    @foreach($plates as $plate)
                    <li>{{$plate->id}}</li>
                    @endforeach
=======

                <ul>
                    @foreach ($plates as $plate)
                        <li>
                            {{ $plate->name }} {{ $plate->price }} &euro; {{ $order->quantity }}
                        </li>
                    @endforeach
                    {{-- {{ $order->plate()->first()->name }} --}}
>>>>>>> Dev
                </ul>
            </div>
        </div>
    </div>
@endsection
