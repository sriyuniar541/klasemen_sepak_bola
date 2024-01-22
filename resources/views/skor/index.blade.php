@extends('index')

@section('title', 'Skor ')

@section('content')

<table class="table mt-5  ">
    {{-- modal tambah klub --}}
   
    <button
        type="button"
        class="btn btn-outline-info bg-white"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
        > 
        <a href="/skor/create">Tambah Skor</a>

    </button>


    {{-- data klub --}}
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Klub</th>
            <th scope="col">Skor</th>
            <th scope="col">Nama Klub</th>
            <th scope="col">Skor</th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 0;
        @endphp

        @forelse ($skor as $item)
            <tr>
                <th scope="row">{{ ++$index }}</th>
                <td>{{ $item->klub->nama_klub}}</td>
                <td>{{ $item->skor }}</td>
                <td>{{ $item->klub_lawan->nama_klub }}</td>
                <td>{{ $item->skor_lawan }}</td>
                
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <p class="mt-5">Data belum tersedia, silahkan input Skor..!</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>



@endsection
