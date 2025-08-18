@extends('main')

@section('konten')
<h1>Edit data</h1>
<form action="/viewdata/{{ $isidata -> id_cctv }}" method="POST">
    @method('PUT')
    @csrf
    <div class="column">
        <div class="mb-3">
            <label class="form-label">title</label>
            <input type="text" class="form-control" placeholder="input title" name="ipn_title" value="{{ $isidata -> title}}">
            @error('ipn_title')
            <div class="validate from-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">ip addres</label>
            <input type="text" class="form-control" placeholder="input ip address" name="ipn_ipad" value="{{ $isidata -> ip_address }}">
             @error('ipn_ipad')
            <div class="validate from-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Stream Url</label>
            <input type="text" class="form-control" placeholder="input ip address" name="ipn_url" value="{{ $isidata -> stream_url }}">
             @error('ipn_url')
            <div class="validate from-text text-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection