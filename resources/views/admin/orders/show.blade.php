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
            </div>
        </div>
    </div>
@endsection
