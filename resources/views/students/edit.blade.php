@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Student</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label><br>
                <input type="radio" name="gender" value="Male" {{ $student->gender == 'Male' ? 'checked' : '' }} required> Male
                <input type="radio" name="gender" value="Female" {{ $student->gender == 'Female' ? 'checked' : '' }} required> Female
            </div>
            <div class="form-group">
                <label for="education">Education</label>
                <select name="education" class="form-control" required>
                    <option value="">Select Education Level</option>
                    <option value="Undergraduate" {{ $student->education == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                    <option value="Postgraduate" {{ $student->education == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                    <option value="PhD" {{ $student->education == 'PhD' ? 'selected' : '' }}>PhD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" required>{{ $student->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $student->phone_number }}" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control">
                @if($student->profile_picture)
                    <img src="{{ asset('images/'.$student->profile_picture) }}" alt="Profile Picture" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="documents">Upload Documents</label>
                <input type="file" name="documents[]" class="form-control" multiple>
                @if($student->documents)
                    <ul>
                        @foreach(json_decode($student->documents) as $document)
                            <li><a href="{{ asset('documents/'.$document) }}">{{ $document }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
