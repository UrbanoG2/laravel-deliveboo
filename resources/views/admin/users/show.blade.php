@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                 
                <!-- Anteprima immagine di preview -->
                @if (!empty($user->logo_img))
                    <div class="mb-3">
                        <img class="w-50" src="{{ asset('storage/' . $user->logo_img) }}" alt="{{ $user->logo_img }}">
                    </div>
                @endif


                <!-- Upload immagine di logo -->
                <div class="mb-3">
                    <label for="logo_img" class="form-label">Restaurant Logo</label>
                    <input class="form-control" type="file" id="logo_img" name="logo_img">
                    @error('logo_img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                @if (!empty($user->banner_img))
                    <div class="mb-3">
                        <img class="w-50" src="{{ asset('storage/' . $user->banner_img) }}" alt="{{ $user->name }}">
                    </div>
                @endif


                <!-- Upload immagine di banner -->
                <div class="mb-3">
                    <label for="banner_img" class="form-label">Restaurant Banner</label>
                    <input class="form-control" type="file" id="banner_img" name="banner_img">
                    @error('banner_img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input class="btn btn-primary" type="submit" value="Save">
            </form>
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
