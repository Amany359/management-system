@extends('panel.layouts.master')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto;">
    <h3 class="mb-4 text-center">كل المهام</h3>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>المبرمج</th>
                    <th>المختبر</th>
                    <th>الحالة</th>
                    <th>الأولوية</th>
                    <th>تحديث الأولوية</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title ?? $task->name }}</td>
                        <td>{{ $task->description ?? 'غير متوفر' }}</td>
                        <td>{{ $task->programmer?->name ?? 'غير معين' }}</td>
                        <td>{{ $task->tester?->name ?? 'غير معين' }}</td>
                        <td><span class="badge bg-{{ taskStatusClass($task->status) }}">{{ $task->status }}</span></td>
                        <td><span class="badge bg-{{ priorityClass($task->priority) }}">{{ $task->priority }}</span></td>
                        <td>
                            <form action="{{ route('admin_manager.tasks.update_priority', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="priority" class="form-select form-select-sm d-inline-block w-auto" required>
                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>منخفضة</option>
                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>متوسطة</option>
                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>مرتفعة</option>
                                    <option value="critical" {{ $task->priority == 'critical' ? 'selected' : '' }}>حرجة</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">تحديث</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@php
    // Helper functions to add colors to status and priority
    function taskStatusClass($status) {
        switch($status) {
            case 'pending':
                return 'warning';
            case 'in_progress':
                return 'info';
            case 'done':
                return 'success';
            case 'needs_fix':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    function priorityClass($priority) {
        switch($priority) {
            case 'low':
                return 'secondary';
            case 'medium':
                return 'primary';
            case 'high':
                return 'warning';
            case 'critical':
                return 'danger';
            default:
                return 'light';
        }
    }
@endphp
