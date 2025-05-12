@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h1>My Tasks</h1>
@if(session('status_message'))
    <div class="alert alert-success">
        {{ session('status_message') }}
    </div>
@endif
    @if($tasks->isEmpty())
        <p class="text-center">لا توجد مهام حالياً.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        @php
                            $role = session('active_role');
                        @endphp

                        @if($role === 'programmer')
                            @if($task->status === 'approved')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button class="btn btn-primary btn-sm">Start</button>
                                </form>
                            @elseif($task->status === 'in_progress')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="done">
                                    <button class="btn btn-success btn-sm">Finish</button>
                                </form>
                            @elseif($task->status === 'needs_fix')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button class="btn btn-warning btn-sm">Return for Fix</button>
                                </form>
                            @else
                                <span class="text-muted">No actions</span>
                            @endif

                        @elseif($role === 'tester')
                            @if($task->status === 'done')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_testing">
                                    <button class="btn btn-primary btn-sm">Start Test</button>
                                </form>
                            @elseif($task->status === 'in_testing')
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="tested_done">
                                    <button class="btn btn-success btn-sm">Finish Test</button>
                                </form>
                                <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}" class="mt-1">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="needs_fix">
                                    <button class="btn btn-danger btn-sm">Return for Fix</button>
                                </form>
                            @else
                                <span class="text-muted">No actions</span>
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
