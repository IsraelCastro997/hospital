@extends('layouts.app')

@section('content')
    <schedulecreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection