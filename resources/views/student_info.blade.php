@extends('layout.master')
@section('title', 'Student Info')

@section('content')

<style>
    .page-header {
        margin-bottom: 2rem;
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
    .page-header h1 i {
        font-size: 1.4rem;
        color: var(--accent);
    }
    .page-header p {
        color: var(--muted);
        font-size: .9rem;
        margin-top: .25rem;
    }

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
    .alert-success {
        background: var(--accent-lt);
        border: 1px solid #c0dcca;
        color: var(--accent);
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
        margin-bottom: 2rem;
    }
    .card-title {
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: .4rem;
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
    .field input::placeholder { color: #c2bdb5; }

    .form-actions {
        margin-top: 1.25rem;
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
    .btn-primary {
        background: var(--accent);
        color: #fff;
    }
    .btn-primary:hover { background: #245030; }
    .btn-ghost {
        background: transparent;
        color: var(--muted);
        border: 1px solid var(--border);
    }
    .btn-ghost:hover { background: var(--bg); color: var(--text); }

    /* Table */
    .table-wrap { overflow-x: auto; }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }
    thead tr {
        border-bottom: 2px solid var(--border);
    }
    thead th {
        text-align: left;
        padding: .6rem .85rem;
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted);
        white-space: nowrap;
    }
    tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .1s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--bg); }
    tbody td {
        padding: .75rem .85rem;
        color: var(--text);
        vertical-align: middle;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .2rem .6rem;
        border-radius: 20px;
        font-size: .75rem;
        font-weight: 500;
    }
    .badge-teal { background: #e1f5ee; color: #0f6e56; }
    .badge-blue { background: #e6f1fb; color: #185fa5; }

    .action-btns { display: flex; gap: .5rem; align-items: center; }
    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .82rem;
        cursor: pointer;
        border: 1px solid var(--border);
        background: transparent;
        transition: background .12s, border-color .12s, color .12s;
        text-decoration: none;
        color: var(--muted);
    }
    .btn-icon:hover { background: var(--accent-lt); border-color: var(--accent); color: var(--accent); }
    .btn-icon.danger:hover { background: var(--danger-lt); border-color: var(--danger); color: var(--danger); }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--muted);
    }
    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: .75rem;
        display: block;
        opacity: .35;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: .25rem;
    }
    .stat-card .stat-label {
        font-size: .75rem;
        color: var(--muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: .3rem;
    }
    .stat-card .stat-num {
        font-size: 1.7rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1;
    }

    .name-cell {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-weight: 500;
    }
    .avatar-sm {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--accent);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        font-weight: 600;
        overflow: hidden;
        flex-shrink: 0;
    }
    .avatar-sm img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
</style>

<div class="page-header">
    <h1><i class="fa-solid fa-users"></i> Students</h1>
    <p>Manage enrollment records and student details.</p>
</div>

{{-- Alerts --}}
@if ($errors->any())
<div class="alert alert-error">
    <i class="fa-solid fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    <i class="fa-solid fa-circle-check"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

{{-- Stats --}}
<div class="stats-row">
    <div class="stat-card">
        <span class="stat-label"><i class="fa-solid fa-users"></i> Total</span>
        <span class="stat-num">{{ $students->count() }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label"><i class="fa-solid fa-venus-mars"></i> Male</span>
        <span class="stat-num">{{ $students->where('gender','Male')->count() }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label"><i class="fa-solid fa-venus-mars"></i> Female</span>
        <span class="stat-num">{{ $students->where('gender','Female')->count() }}</span>
    </div>
</div>

{{-- Add Student Form --}}
<div class="card">
    <div class="card-title"><i class="fa-solid fa-user-plus"></i> Add New Student</div>
    <form action="{{ route('insert') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="field">
                <label><i class="fa-regular fa-id-card"></i> First Name</label>
                <input type="text" name="first_name" placeholder="e.g. Maria" value="{{ old('first_name') }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-id-card"></i> Last Name</label>
                <input type="text" name="last_name" placeholder="e.g. Santos" value="{{ old('last_name') }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-envelope"></i> Email</label>
                <input type="email" name="email" placeholder="student@email.com" value="{{ old('email') }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-venus-mars"></i> Gender</label>
                <input type="text" name="gender" placeholder="Male / Female" value="{{ old('gender') }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-phone"></i> Phone</label>
                <input type="text" name="phone" placeholder="+63 9XX XXX XXXX" value="{{ old('phone') }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-location-dot"></i> Address</label>
                <input type="text" name="address" placeholder="City, Province" value="{{ old('address') }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-book"></i> Course</label>
                <input type="text" name="course" placeholder="e.g. BSIT" value="{{ old('course') }}">
            </div>
            <div class="field">
                <label><i class="fa-solid fa-layer-group"></i> Year</label>
                <input type="text" name="year" placeholder="e.g. 2" value="{{ old('year') }}">
            </div>
            <div class="field">
                <label><i class="fa-regular fa-image"></i> Profile Image</label>
                <input type="file" name="profile_image" accept="image/*">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add Student
            </button>
        </div>
    </form>
</div>

{{-- Students Table --}}
<div class="card" style="padding: 0; overflow: hidden;">
    <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between;">
        <span class="card-title" style="margin: 0;"><i class="fa-solid fa-table-list"></i> Enrollment Records</span>
        <span style="font-size:.8rem; color: var(--muted);">{{ $students->count() }} student(s)</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
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
                    <td>
                        <div class="name-cell">
                            <span class="avatar-sm">
                                @if ($student->profile_image)
                                    <img src="{{ asset('storage/' . $student->profile_image) }}" alt="{{ $student->first_name }}">
                                @else
                                    {{ strtoupper(substr($student->first_name, 0, 1)) }}{{ strtoupper(substr($student->last_name, 0, 1)) }}
                                @endif
                            </span>
                            <span>{{ $student->first_name }} {{ $student->last_name }}</span>
                        </div>
                    </td>
                    <td style="color: var(--muted);">{{ $student->email }}</td>
                    <td>
                        <span class="badge {{ $student->gender === 'Male' ? 'badge-blue' : 'badge-teal' }}">
                            <i class="fa-solid fa-{{ $student->gender === 'Male' ? 'mars' : 'venus' }}"></i>
                            {{ $student->gender }}
                        </span>
                    </td>
                    <td style="color: var(--muted);">{{ $student->phone }}</td>
                    <td style="color: var(--muted);">{{ $student->address }}</td>
                    <td>
                        <span class="badge badge-teal">{{ $student->course }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge badge-blue"><i class="fa-solid fa-layer-group"></i> {{ $student->year }}</span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('student.edit', $student->id) }}" class="btn-icon" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('student.delete', $student->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon danger" title="Delete" onclick="return confirm('Delete {{ $student->first_name }}?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fa-solid fa-inbox"></i>
                            <p>No students enrolled yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection