@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <form action="{{ route('team_leader.tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('panel.team-leader.tasks.form', ['buttonText' => 'Update Task'])

    </form>
</div>
@endsection
