
@extends('panel.layouts.master')

@section('content')
<div class="container">
      <h2>لوحة تحكم قائد الفريق</h2>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('team_leader.tasks.index') }}" class="card text-center p-4 bg-primary text-white">
                <i class="bx bx-task" style="font-size: 2rem;"></i>
                <h5 class="mt-2">team_leader </h5>
            </a>
        </div>
    </div>
</div>
@endsection
