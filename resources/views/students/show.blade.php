@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h5>
                <p class="card-text">Gender: {{ $student->gender }}</p>
                <p class="card-text">Education: {{ $student->education }}</p>
                <p class="card-text">Address: {{ $student->address }}</p>
                <p class="card-text">Phone Number: {{ $student->phone_number }}</p>
                @if($student->profile_picture)
                    <p class="card-text">Profile Picture:</p>
                    <img src="{{ asset('images/'.$student->profile_picture) }}" alt="Profile Picture" width="100">
                @endif
                @if($student->documents)
                    <p class="card-text">Documents:</p>
                    <ul>
                        @foreach(json_decode($student->documents) as $document)
                            <li><a href="{{ asset('documents/'.$document) }}">{{ $document }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-primary mt-3">Back to List</a>
    </div>
@endsection
