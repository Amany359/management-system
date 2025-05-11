@extends('panel.layouts.master')

@section('content')
<div class="container">
    <h4 class="mb-4">QA Manager Dashboard</h4>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('qa_manager.tasks.index') }}" class="card text-center p-4 bg-primary text-white">
                <i class="bx bx-task" style="font-size: 2rem;"></i>
                <h5 class="mt-2">Manage Tester Tasks</h5>
            </a>
        </div>
    </div>
</div>
@endsection
