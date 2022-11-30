@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1>Daftar User</h1>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($buku as $key)
                            @if($key->status == "Aktif")                               
                            <div class="col-4 me-3">
                                <div class="card rounded" style="width: 18rem;">
                                    <img src="{{ asset('storage/' . $key->cover) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-text text-center">{{ $key->judul }}</h4>
                                        <p class="card-text text-center mb-3">{{ $key->user->name }}</p>
                                        <p class="card-text">{{ $key->penerbit }}</p>
                                        <input type="text" class="form-control rounded" disabled value="{{ $key->sinopsis }}">
                                    </div>
                                </div>
                            </div>
                            @else
                                
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
