@extends('main')

@section('konten')
<a href="/viewdata/crude">masukkan data</a>
<div class="alert">
    <b>nama: </b> {{ $biodatacctv['nama'] }}
    <br>
    <b>tempat: </b> {{ $biodatacctv['tempat'] }}
</div>
@if (session('success'))
<div class="alert alert-primary">{{ session('success') }}</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">ipaddres</th>
            <th scope="col">Stream Url</th>
            <th scope="col">status</th>
            <th scope="col">last online</th>
            <th scope="col">last offline</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tampilkansemua as $itemsemua)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $itemsemua->title }}</td>
            <td>{{$itemsemua->ip_address}}</td>
            <td>{{$itemsemua->stream_url}}</td>
            <td>{{$itemsemua->status}}</td>
            <td>{{$itemsemua->last_online}}</td>
            <td>{{$itemsemua->last_offline}}</td>
            <td>
                <a href="/viewdata/{{$itemsemua->id_cctv}}/edit" type="button" class="btn btn-warning">edit</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hapus{{ $itemsemua->id_cctv }}">
                    hapus
                </button>
                <!-- <button type="button" class="btn btn-danger" >hapus</button> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
@foreach ($tampilkansemua as $items)
<div class="modal fade" id="hapus{{ $items->id_cctv }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/viewdata/{{ $items -> id_cctv }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ANDA YAKIN MAU MENGHAPUS?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="column">
                    <P>TITLE: {{$items->title}}</P>
                    <P>IP ADDRES: {{$items->ip_address}}</P>
                </div>
            </div>
            <div class="modal-footer">
                <button type="sublit" class="btn btn-primary">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection