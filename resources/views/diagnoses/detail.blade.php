@extends('layouts.app')

@section('content')
    <diagnosecreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection