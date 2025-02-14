
@extends('template.parent')

@section('title', 'Importation configuration note')

@section('content')
    
    <h1>Import Configuration note</h1>
    <form action="{{route('importationConfigurationNote')}}" method="post" enctype="multipart/form-data" id="uploadForm">
    @csrf
        
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Upload configuration note</label>
        <div class="col-sm-10">
            <input type="file" name="file" id="" class="form-control">
            <input type="submit" value="Importer" class="btn btn-primary" id="primary-popover-content" data-container="body" data-toggle="popover" title="Primary color states" data-placement="bottom" >
            @error("error")
                {{$message}}
                @enderror
        </div>
    </div>
    </form>

@endsection
