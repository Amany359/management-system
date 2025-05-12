@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h2>لوحة تحكم قائد الفريق</h2>
    <a href="{{ route('team_leader.tasks.create') }}" class="btn btn-success">إضافة مهمة</a>

    <ul class="list-group mt-3">
        @forelse ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $task->title }} - {{ $task->status }}
                <a href="{{ route('team_leader.tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">تعديل</a>
            </li>
        @empty
            <li class="list-group-item">لا توجد مهام.</li>
        @endforelse
    </ul>
</div>
@endsection

