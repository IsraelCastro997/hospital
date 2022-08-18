@extends('layouts.app')

@section('content')
    <patientscreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection