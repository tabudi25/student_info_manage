@extends('layout.master')
@section('title', 'Edit Student')

@section('content')

<style>
    .page-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem;
        font-weight: 600;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .65rem;
    }
    .page-header h1 i { font-size: 1.4rem; color: var(--accent); }
    .page-header p { color: var(--muted); font-size: .9rem; margin-top: .25rem; }

    .alert {
        border-radius: var(--radius);
        padding: .85rem 1.1rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: .75rem;
        align-items: flex-start;
        font-size: .88rem;
    }
    .alert-error {
        background: var(--danger-lt);
        border: 1px solid #f5c4c0;
        color: var(--danger);
    }
    .alert i { margin-top: 2px; flex-shrink: 0; }
    .alert ul { list-style: none; padding: 0; }
    .alert ul li + li { margin-top: .25rem; }

    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1.75rem;
        max-width: 800px;
    }
    .card-title {
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: .4rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .student-banner {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: var(--accent-lt);
        border: 1px solid #c0dcca;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
    .avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: var(--accent);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
        overflow: hidden;
    }
    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .student-banner .name {
        font-weight: 600;
        font-size: 1rem;
        color: var(--text);
    }
    .student-banner .meta {
        font-size: .82rem;
        color: var(--muted);
        margin-top: .1rem;
    }

    .section-label {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--muted);
        margin: 1.25rem 0 .75rem;
        display: flex;
        align-items: center;
        gap: .35rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: .35rem;
    }
    .field label {
        font-size: .8rem;
        font-weight: 500;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: .35rem;
    }
    .field label i { font-size: .75rem; }
    .field input {
        height: 40px;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0 .85rem;
        font-family: 'DM Sans', sans-serif;
        font-size: .9rem;
        color: var(--text);
        background: var(--surface);
        transition: border-color .15s, box-shadow .15s;
        outline: none;
        width: 100%;
    }
    .field input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(45,90,61,.1);
    }

    .form-actions {
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        display: flex;
        gap: .75rem;
        align-items: center;
    }
    .btn {
        height: 40px;
        padding: 0 1.25rem;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: .9rem;
        font-weight: 500;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        transition: background .15s, transform .1s;
        text-decoration: none;
    }
    .btn:active { transform: scale(.98); }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #245030; }
    .btn-ghost {
        background: transparent;
        color: var(--muted);
        border: 1px solid var(--border);
    }
    .btn-ghost:hover { background: var(--bg); color: var(--text); }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: .4rem;
        font-size: .82rem;
        color: var(--muted);
        margin-bottom: 1.5rem;
    }
    .breadcrumb a { color: var(--accent); text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb i { font-size: .65rem; }
</style>

{{-- Breadcrumb --}}
<div class="breadcrumb">
    <a href="{{ route('student.info') }}"><i class="fa-solid fa-house"></i> Students</a>
    <i class="fa-solid fa-chevron-right"></i>
    <span>Edit Record</span>
</div>

<div class="page-header">
    <div>
        <h1><i class="fa-solid fa-pen-to-square"></i> Edit Student</h1>
        <p>Update the student's enrollment information below.</p>
    </div>
    <a href="{{ route('student.info') }}" class="btn btn-ghost">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
</div>

@if ($errors->any())
<div class="alert alert-error" style="max-width: 800px;">
    <i class="fa-solid fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
    {{-- Student banner --}}
    <div class="student-banner">
        <div class="avatar">
            @if ($student->profile_image)
                <img src="{{ asset('storage/' . $student->profile_image) }}" alt="{{ $student->first_name }}">
            @else
                {{ strtoupper(substr($student->first_name, 0, 1)) }}{{ strtoupper(substr($student->last_name, 0, 1)) }}
            @endif
        </div>
        <div>
            <div class="name">{{ $student->first_name }} {{ $student->last_name }}</div>
            <div class="meta">{{ $student->course }} &middot; Year {{ $student->year }} &middot; {{ $student->email }}</div>
        </div>
    </div>

    <form action="{{ route('student.update', $student->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="section-label"><i class="fa-solid fa-user"></i> Personal Details</div>
        <div class="form-grid">
            <div class="field">
                <label><i class="fa-regular fa-id-card"></i> First Name</label>
                <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', $student->first_name) }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-id-card"></i> Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', $student->last_name) }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-envelope"></i> Email</label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email', $student->email) }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-venus-mars"></i> Gender</label>
                <input type="text" name="gender" placeholder="Gender" value="{{ old('gender', $student->gender) }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-phone"></i> Phone</label>
                <input type="text" name="phone" placeholder="Phone" value="{{ old('phone', $student->phone) }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-location-dot"></i> Address</label>
                <input type="text" name="address" placeholder="Address" value="{{ old('address', $student->address) }}">
            </div>
        </div>

        <div class="section-label"><i class="fa-solid fa-graduation-cap"></i> Academic Details</div>
        <div class="form-grid">
            <div class="field">
                <label><i class="fa-solid fa-book"></i> Course</label>
                <input type="text" name="course" placeholder="Course" value="{{ old('course', $student->course) }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-layer-group"></i> Year Level</label>
                <input type="text" name="year" placeholder="Year" value="{{ old('year', $student->year) }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-image"></i> Profile Image</label>
                <input type="file" name="profile_image" accept="image/*">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
            <a href="{{ route('student.info') }}" class="btn btn-ghost">
                <i class="fa-solid fa-xmark"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection