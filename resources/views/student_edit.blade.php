@extends('layout.master')
@section('content')
    <h1>Edit Student</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('student.update', $student->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', $student->first_name) }}">
        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', $student->last_name) }}">
        <input type="email" name="email" placeholder="Email" value="{{ old('email', $student->email) }}">
        <input type="text" name="gender" placeholder="Gender" value="{{ old('gender', $student->gender) }}">
        <input type="text" name="phone" placeholder="Phone" value="{{ old('phone', $student->phone) }}">
        <input type="text" name="address" placeholder="Address" value="{{ old('address', $student->address) }}">
        <input type="text" name="course" placeholder="Course" value="{{ old('course', $student->course) }}">
        <input type="text" name="year" placeholder="Year" value="{{ old('year', $student->year) }}">
        <button type="submit">Update</button>
        <a href="{{ route('student.info') }}">Cancel</a>
    </form>
@endsection
