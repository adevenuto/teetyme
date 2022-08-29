@extends('layouts.main')
@section('content')
    <h1>{{ $course->name }}</h1>

    @foreach($teeboxes as $teebox => $holes)
        <h3>{{ $teebox }}</h3>
        @foreach($holes as $hole)
            <p>
                <strong>Hole: </strong><small>{{ $hole->number }}</small> 
                <strong>Yards: </strong><small>{{ $hole->length_yds }}yds/{{ $hole->length_m }}m</small> 
                <strong>SI: </strong><small>{{ $hole->length_yds }}</small> 
                <strong>Slope/Rating: </strong><small>{{ $hole->teebox_slope }}/{{ $hole->teebox_rating }}</small>
            </p>
        @endforeach
    @endforeach
    <hr>
@stop