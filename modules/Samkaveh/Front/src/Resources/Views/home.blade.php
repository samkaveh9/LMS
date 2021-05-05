@extends('Front::layouts.master')
@section('main')
<article class="container article">
    @include('Front::layouts.heroHeader')
    @include('Front::pages.latestCourses')
    @include('Front::pages.popularCourses')
</article>
@include('Front::pages.latestArticles')
@endsection
