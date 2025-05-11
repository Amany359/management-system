@extends('panel.layouts.master')

@section('content')

<div class="container">
    <h1>My Tasks</h1>
    
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
                        @if($task->status === 'assigned')
                            <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="start">
                                <button class="btn btn-primary btn-sm">Start</button>
                            </form>
                        @elseif($task->status === 'start')
                            <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="finish">
                                <button class="btn btn-success btn-sm">Finish</button>
                            </form>
                        @elseif($task->status === 'finish')
                            <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="test">
                                <button class="btn btn-warning btn-sm">Test</button>
                            </form>
                        @elseif($task->status === 'test')
                            <form method="POST" action="{{ route('programmer.tasks.updateStatus', $task->id) }}">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="return_for_fix">
                                <button class="btn btn-danger btn-sm">Return for Fix</button>
                            </form>
                        @else
                            <span class="text-muted">Done</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
