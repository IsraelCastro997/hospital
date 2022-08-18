@extends('layouts.app')

@section('content')
    <areacreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection