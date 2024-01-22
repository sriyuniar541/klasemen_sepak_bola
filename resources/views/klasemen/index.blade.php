@extends('index')

@section('title', 'Klasement ')

@section('content')



<div class="klasemen">
    <div>
        <h2 class="judul_klasement">Klasement Sepak Bola</h2>
    </div>

    {{-- title --}}
    <div class="thead  mb-4">
        <div class="container text-center">
            <div class="row align-items-start">
              <div class="col nomor_clasement">
                <h5 >#</h5>
              </div>
              <div class="col">
                <h5 >Klub</h5>
              </div>
              <div class="col">
                <h5 >Main</h5>
              </div>
              <div class="col">
                <h5 >Menang</h5>
              </div>
              <div class="col">
                <h5 >Kalah</h5>
              </div>
              <div class="col">
                <h5 >Seri</h5>
              </div>
              <div class="col">
                <h5 >GM</h5>
              </div>
              <div class="col">
                <h5 >GK</h5>
              </div>
              <div class="col">
                <h5 >Poin</h5>
              </div>
            </div>
        </div>
    </div>

    {{-- index untuk buat nomor--}}
    @php
        $index = 0;
    @endphp

    {{-- klasemen --}}
    @forelse ($klasemen as $item)
    <div class="tbody mb-2 shadow-lg rounded">
         
        <div class="container text-center">
            <div class="row align-items-start">
              
              <div class="col nomor_clasement">
                <h6 >{{ ++$index }}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->klub->nama_klub}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->MA}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->ME}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->K}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->S}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->GM}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->GK}}</h6>
              </div>
              <div class="col">
                <h6 >{{$item->poin}}</h6>
              </div>
            </div>
        </div>   
    </div>
    @empty
        <div class="col">            
          <h6 class="mt-5">Data akan tersedia jika telah dilakukan pengimputan pertandingan dan skor..!</h6>
        </div>
    @endforelse


</div>

@endsection
