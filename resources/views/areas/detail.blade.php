@extends('layouts.app')

@section('content')
    <areacreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection