@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1>Daftar Buku</h1>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success mb-3" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-boredered p-3 text-center">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Sinopsis</th>
                                    <th>Penerbit</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th>Status</th>
                                    @endif
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $key)
                                    <tr>
                                        <td>{{ $key->isbn }}</td>
                                        <td><img src="{{ asset('storage/' . $key->cover) }}" style="width: 150px"
                                                alt=""></td>
                                        <td>{{ $key->judul }}</td>
                                        <td>
                                            <details>
                                                <summary>Sinopsis</summary>>{{ $key->judul }}
                                            </details>
                                        </td>
                                        <td>{{ $key->penerbit }}</td>

                                        @if (Auth::user()->role == 'admin')
                                            @if ($key->status == 'Aktif')
                                                <td>
                                                    <p class="bg-success rounded text-light">{{ $key->status }}</p>
                                                </td>
                                            @else
                                                <td>
                                                    <p class="bg-danger rounded text-light">{{ $key->status }}</p>
                                                </td>
                                            @endif
                                        @endif
                                        <td>{{ $key->kategori->nama_kategori }}</td>
                                        <td>{{ $key->user->name }}</td>
                                        <td>
                                            <form action="{{ route('buku.destroy', $key->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('buku.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="isbn"
                                                                value="{{ $key->isbn }}">
                                                            <label for="formFloatingInput">ISBN</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="judul"
                                                                value="{{ $key->judul }}">
                                                            <label for="formFloatingInput">Judul</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="sinopsis"
                                                                value="{{ $key->sinopsis }}">
                                                            <label for="formFloatingInput">Sinopsis</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="penerbit"
                                                                value="{{ $key->penerbit }}">
                                                            <label for="formFloatingInput">Penerbit</label>
                                                        </div>
                                                        @if (Auth::user()->role == 'admin')
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control" name="status"
                                                                value="{{ $key->status }}">
                                                            <label for="formFloatingInput">Penerbit</label>
                                                            </div>
                                                        @endif
                                                        <div class="mb-3 form-floating text-center">
                                                            <img src="{{ asset('storage/' . $key->cover) }}"
                                                                style="width: 150px" alt="">
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="file" class="form-control" name="cover"
                                                                value="{{ $key->cover }}">
                                                            <label for="formFloatingFile">Cover</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <select name="kategori_id" id="" class="form-select">
                                                                <option selected disabled>Pilih Kategori</option>
                                                                @foreach ($kategori as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $key->kategori_id ? 'selected' : '' }}>
                                                                        {{ $item->nama_kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="Submit" class="btn btn-warning">Edit</button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="isbn" required>
                        <label for="formFloatingInput">ISBN</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="judul" required>
                        <label for="formFloatingInput">Judul</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="sinopsis" required>
                        <label for="formFloatingInput">Sinopsis</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="penerbit">
                        <label for="formFloatingInput">Penerbit</label>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="status" required>
                            <label for="formFloatingInput">Status</label>
                        </div>
                    @endif
                    <div class="mb-3 form-floating">
                        <input type="file" class="form-control" name="cover" required>
                        <label for="formFloatingFile">Cover</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <select name="kategori_id" id="" class="form-select">
                            <option selected disabled>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
                                    {{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
