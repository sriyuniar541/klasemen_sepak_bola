@extends('index')

@section('title', 'Daftar Klub')

@section('content')

<table class="table mt-5  mb-2 table-light">
    {{-- modal tambah klub --}}
   
    <button
        type="button"
        class="btn btn-outline-info bg-white"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"> 
        Tambah Klub
    </button>


    <form
        action="{{url('/klub/store')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf 
        <!-- Button trigger modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1
                            class="modal-title fs-5"
                            id="exampleModalLabel"
                        >
                            Tambah Klub
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>

                    <div class="modal-body">
                        {{-- nama klub --}}
                        <div class="mb-3">
                            <label for="nama_klub" class="form-label"
                                >Nama Klub</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="nama_klub"
                                name = 'nama_klub'

                            />
                        </div>

                        {{-- kota /districts--}} 
                        <div class="mb-3">
                            <label for="kota_klub" class="form-label"
                                >Kota</label
                            >
                           
                            <select class="form-select" id="kota_klub" name = "kota_klub" aria-label="Floating label select example">
                                @foreach ($districts as $item)
                                    <option >{{$item->name ?? 'Kota Tidak Tersedia'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            Save
                        </button>
                    </div>
    </form>

    {{-- data klub --}}
    <thead>
        <tr class="text-center bg-white text-center">
            <th scope="col" >#</th>
            <th scope="col">Nama Klub</th>
            <th scope="col">Kota</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @php
            $index = 0;
        @endphp

        @forelse ($klub as $item)
            <tr>
                <th scope="row">{{ ++$index }}</th>
                <td>{{ $item->nama_klub }}</td>
                <td>{{ $item->kota_klub }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <p class="mt-5">Data belum tersedia, silahkan input klub..!</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
