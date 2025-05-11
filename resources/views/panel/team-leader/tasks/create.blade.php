@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h2>Add New Task</h2>

    <form action="{{ route('team_leader.tasks.store') }}" method="POST">
        @csrf

        @include('panel.team-leader.tasks.form', ['buttonText' => 'Create Task'])
        
    
    </form>
</div>
@endsection
