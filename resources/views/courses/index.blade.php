@extends('layouts.main')
@section('content')
    <ul>
        @foreach($courses as $course)
            <li>
                <a target="_blank" href="/course/{{$course->id}}/details">{{ $course->name }}</a>
            </li>  
        @endforeach
    </ul>
@stop