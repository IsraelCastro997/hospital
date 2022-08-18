@extends('layouts.app')

@section('content')
    <diagnosecreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection