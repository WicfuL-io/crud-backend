@extends('main')

@section('konten')
<h1>Pengisian data</h1>
<form action="/viewdata" method="POST">
    @csrf
    <div class="column">
        <div class="mb-3">
            <label class="form-label">title</label>
            <input type="text" class="form-control" placeholder="input title" name="ipn_title" value="{{ old('ipn_title') }}">
            @error('ipn_title')
            <div class="validate from-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">ip addres</label>
            <input type="text" class="form-control" placeholder="input ip address" name="ipn_ipad" value="{{ old('ipn_ipad') }}">
             @error('ipn_ipad')
            <div class="validate from-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Stream Url</label>
            <input type="text" class="form-control" placeholder="input ip address" name="ipn_url" value="{{ old('ipn_url') }}">
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