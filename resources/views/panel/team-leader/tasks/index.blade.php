@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h2>مهام هذا الأسبوع</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('team_leader.tasks.create') }}" class="btn btn-primary mb-3">إضافة مهمة جديدة</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>المبرمج</th>
                <th>المختبر</th>
                <th>الحالة</th>
                <th>الأولوية</th>
                <th>تاريخ التنفيذ</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->programmer?->name }}</td>
                    <td>{{ $task->tester?->name ?? 'غير معيّن' }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->scheduled_for_date }}</td>
                    <td>
                        <a href="{{ route('team_leader.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                    
                        <!-- زر حذف المهمة -->
                        <form action="{{ route('team_leader.tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه المهمة؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    
                        <!-- نموذج تعيين مختبر -->
                        <form action="{{ route('team_leader.tasks.assignTester', $task->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <select name="tester_id" onchange="this.form.submit()" class="form-select form-select-sm d-inline-block w-auto">
                                <option value="">تعيين مختبر</option>
                                @foreach($users as $user)
                                    @if($user->hasRole('tester'))
                                        <option value="{{ $user->id }}" {{ $task->tester_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
