@extends('layouts.app')

@section('content')
    <diagnosecreate-component :number="3" v-bind:detailsid="{{$detailN}}"/>
@endsection