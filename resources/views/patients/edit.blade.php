@extends('layouts.app')

@section('content')
    <patientscreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection