@extends('layout.master')
@section('content')
    <h1>Student Info</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('insert') }}" method="post">
        @csrf
        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        <input type="text" name="gender" placeholder="Gender" value="{{ old('gender') }}">
        <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
        <input type="text" name="course" placeholder="Course" value="{{ old('course') }}">
        <input type="text" name="year" placeholder="Year" value="{{ old('year') }}">
        <button type="submit">Submit</button>
    </form>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Course</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->course }}</td>
                    <td>{{ $student->year }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}">Edit</a>
                        |
                        <form action="{{ route('student.delete', $student->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No students yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
