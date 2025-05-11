@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h2>تعيين مختبر للمهمة: <strong>{{ $task->title }}</strong></h2>

    <form action="{{ route('team_leader.tasks.assignTester', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tester_id" class="form-label">اختر المختبر</label>
            <select name="tester_id" id="tester_id" class="form-control" required>
                <option value="">-- اختر المختبر --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->tester_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">تعيين المختبر</button>
        <a href="{{ route('team_leader.tasks.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
