@extends('welcome')
{{--@section('title',$title)--}}
@section('content')
<x-doctor-list :doctors="$doctors" />
@endsection
