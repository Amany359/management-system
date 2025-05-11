@extends('panel.layouts.master')

@section('content')
    <div class="container">
        <h1>مهام التيسترز</h1>

        <!-- فلترة المهام -->
        <form action="{{ route('qa_manager.tasks.index') }}" method="GET">
            <div class="form-group">
                <label for="status">حالة المهمة</label>
                <select name="status" id="status" class="form-control">
                    <option value="">اختر الحالة</option>
                    <option value="pending">قيد الانتظار</option>
                    <option value="in_progress">قيد التنفيذ</option>
                    <option value="completed">مكتملة</option>
                    <option value="approved">معتمدة</option>
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_to">الموظف المعين</label>
                <select name="assigned_to" id="assigned_to" class="form-control">
                    <option value="">اختر الموظف</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">فلترة</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>اسم المهمة</th>
                    <th>حالة المهمة</th>
                    <th>الموظف المعين</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->assigned_to }}</td>
                        <td>
                            @if($task->status != 'approved')
                                <form action="{{ route('qa_manager.tasks.approve', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">اعتماد</button>
                                </form>
                            @endif

                            <form action="{{ route('qa_manager.tasks.reschedule', $task->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="date" name="scheduled_for" class="form-control" value="{{ $task->scheduled_for }}">
                                </div>
                                <button type="submit" class="btn btn-warning">تعديل الجدولة</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
