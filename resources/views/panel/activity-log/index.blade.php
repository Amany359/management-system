@extends('panel.layouts.master') {{-- تأكد إن ده المسار الصحيح للـ layout --}}

@section('title', 'سجلات التغييرات')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">سجلات تغييرات المهام</h3>

    {{-- فلتر بحث اختياري --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="status" class="form-control" placeholder="بحث بالحالة">
        </div>
        <div class="col-md-4">
            <input type="date" name="date" class="form-control" placeholder="بحث بالتاريخ">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">بحث</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>التاريخ</th>
                    <th>المستخدم</th>
                    <th>المهمة</th>
                    <th>الحالة القديمة</th>
                    <th>الحالة الجديدة</th>
                    <th>الملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
    <td>{{ $log->user->name ?? 'غير معروف' }}</td>
    <td>{{ $log->task->title ?? '-' }}</td>
    <td>
        <span class="badge bg-danger">{{ $log->old_status ?? '-' }}</span>
    </td>
    <td>
        <span class="badge bg-success">{{ $log->new_status ?? '-' }}</span>
    </td>
    <td>{{ $log->note ?? '-' }}</td>
</tr>

                @empty
                    <tr>
                        <td colspan="7">لا توجد سجلات تغييرات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
