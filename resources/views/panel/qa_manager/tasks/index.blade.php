@extends('panel.layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">مهام التيسترز</h2>

    <!-- فلترة المهام -->
    <div class="card mb-4">
        <div class="card-header">فلترة المهام</div>
        <div class="card-body">
            <form action="{{ route('qa_manager.tasks.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">حالة المهمة</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">اختر الحالة</option>
                        <option value="pending">قيد الانتظار</option>
                        <option value="in_progress">قيد التنفيذ</option>
                        <option value="completed">مكتملة</option>
                        <option value="approved">معتمدة</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="assigned_to" class="form-label">الموظف المعين</label>
                    <select name="tester_id" id="assigned_to" class="form-control">
                        <option value="">اختر الموظف</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">فلترة</button>
                </div>
            </form>
        </div>
    </div>

    <!-- جدول المهام -->
    <div class="card">
        <div class="card-header">قائمة المهام</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>اسم المهمة</th>
                        <th>الحالة</th>
                        <th>المعين</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->tester?->name ?? 'غير محدد' }}</td>
                            <td>
                                @if($task->status != 'approved')
                                    <form action="{{ route('qa_manager.tasks.approve', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">اعتماد</button>
                                    </form>
                                @endif

                                <form action="{{ route('qa_manager.tasks.reschedule', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="date" name="scheduled_for_date" class="form-control form-control-sm d-inline w-auto" value="{{ $task->scheduled_for_date }}">
                                    <button type="submit" class="btn btn-warning btn-sm mt-1">تعديل الجدولة</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">لا توجد مهام حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
