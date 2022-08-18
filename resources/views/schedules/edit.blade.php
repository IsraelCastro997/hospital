@extends('layouts.app')

@section('content')
    <schedulecreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection