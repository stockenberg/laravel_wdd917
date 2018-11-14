@extends('master')

@section('jumbotron')
    <h1 class="display-4 font-italic">Update die News mit der ID: {{$news->id}}</h1>
@stop

@section('main')
    <ul>
        @if($errors)
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        @endif
    </ul>

    <form action="{{route('news.update', ['id' => $news->id])}}" method="post" role="form" enctype="multipart/form-data">

        {{csrf_field()}}

        <legend>Form Title</legend>

        <div class="form-group">
            <label for="">Headline</label>
            <input type="text" class="form-control" name="headline" id="" value="{{(old('headline')) ? old('headline') : $news->headline}}" placeholder="Input...">
        </div>
        <div class="form-group">
            <p>Aktuelles Bild:</p>
            <img src="{{url()->route('home')}}/storage/{{$news->img_name}}" width="300" alt="">
            <div class="custom-file">

                <input type="file" class="custom-file-input" name="img" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="30" class="form-control" rows="10">{{(old('content')) ? old('content') : $news->content}}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop