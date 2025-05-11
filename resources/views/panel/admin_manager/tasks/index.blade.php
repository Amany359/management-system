@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h3 class="mb-4">كل المهام</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
                    <td>{{ $task->description ?? '-' }}</td>
                    <td>{{ $task->programmer?->name ?? 'غير معين' }}</td>
                    <td>{{ $task->tester?->name ?? 'غير معين' }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>
                        <form action="{{ route('admin_manager.tasks.update_priority', $task->id) }}" method="POST">
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
@endsection
