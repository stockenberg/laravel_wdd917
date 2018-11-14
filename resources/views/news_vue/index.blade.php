@extends('master')


@section('jumbotron')
    <h1 class="display-4 font-italic">Alle News</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
@stop

@section('main')
    <manage-news></manage-news>
@stop