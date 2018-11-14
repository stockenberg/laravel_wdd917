@extends('master')

@section('jumbotron')
    <h1 class="display-4 font-italic">Erstelle einen neuen Blog Eintrag</h1>
@stop

@section('main')

    <ul>
        @if($errors)
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        @endif
    </ul>
    <form action="{{route('news.store')}}" method="post" role="form" enctype="multipart/form-data">
        {{csrf_field()}}
        <legend>Form Title</legend>

        <div class="form-group">
            <label for="">Headline</label>
            <input type="text" class="form-control" name="headline" id="" value="{{old('headline')}}" placeholder="Input...">
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="img" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="30" class="form-control" rows="10">{{old('content')}}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop