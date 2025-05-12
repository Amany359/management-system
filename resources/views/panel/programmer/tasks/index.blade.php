@extends('panel.layouts.master')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center text-primary">المهام الخاصة بي</h1>
    
    @if(session('status_message'))
        <div class="alert alert-success text-center">
            {{ session('status_message') }}
        </div>
    @endif

    @if($tasks->isEmpty())
        <p class="text-center text-muted">لا توجد مهام حالياً.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>تغيير الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>
                        <span class="badge 
                            @if($task->status === 'approved') badge-success
                            @elseif($task->status === 'in_progress') badge-primary
                            @elseif($task->status === 'done') badge-secondary
                            @elseif($task->status === 'needs_fix') badge-warning
                            @elseif($task->status === 'in_testing') badge-info
                            @elseif($task->status === 'tested_done') badge-success
                            @endif">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $role = session('active_role');
                        @endphp

                        @if($role === 'programmer')
                            @if($task->status === 'approved')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button class="btn btn-primary btn-sm">ابدأ</button>
                                </form>
                            @elseif($task->status === 'in_progress')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="done">
                                    <button class="btn btn-success btn-sm">أنهى</button>
                                </form>
                            @elseif($task->status === 'needs_fix')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button class="btn btn-warning btn-sm">إعادة للتصحيح</button>
                                </form>
                            @else
                                <span class="text-muted">لا توجد إجراءات</span>
                            @endif

                        @elseif($role === 'tester')
                            @if($task->status === 'done')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_testing">
                                    <button class="btn btn-primary btn-sm">ابدأ الاختبار</button>
                                </form>
                            @elseif($task->status === 'in_testing')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="tested_done">
                                    <button class="btn btn-success btn-sm">اختبار منتهي</button>
                                </form>
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="mt-1 d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="needs_fix">
                                    <button class="btn btn-danger btn-sm">إعادة للتصحيح</button>
                                </form>
                            @else
                                <span class="text-muted">لا توجد إجراءات</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
