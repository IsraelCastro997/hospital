@extends('layouts.app')

@section('content')
    <inventarycreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection