@extends('layouts.app')

@section('content')
    <inventarycreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection