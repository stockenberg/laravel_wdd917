@extends('master')

@section('jumbotron')
    <h1 class="display-4 font-italic">Alle deine News Einträge</h1>
@stop

@section('main')
<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>headline</th>
        <th>img_name</th>
        <th>content</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>manage</th>
    </tr>
    </thead>
    <tbody>
    @foreach($news as $entry)
    <tr>
        <td>{{$entry->id}}</td>
        <td>{{$entry->headline}}</td>
        <td>{{$entry->img_name}}</td>
        <td>{{$entry->content}}</td>
        <td>{{$entry->created_at}}</td>
        <td>{{$entry->updated_at}}</td>
        <td>
            <a href="{{route('news.destroy', ['id' => $entry->id])}}" class="btn btn-danger">Delete</a>
            <a href="{{route('news.edit', ['id' => $entry->id])}}" class="btn btn-warning">Edit</a>
        </td>
    </tr>
    @endforeach

    </tbody>
</table>
@stop