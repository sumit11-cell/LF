@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Student</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label> 
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label><br>
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" required> Female
            </div>
            <div class="form-group">
                <label for="education">Education</label>
                <select name="education" class="form-control" required>
                    <option value="">Select Education Level</option>
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Postgraduate">Postgraduate</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control">
            </div>
            <div class="form-group">
                <label for="documents">Upload Documents</label>
                <input type="file" name="documents[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
