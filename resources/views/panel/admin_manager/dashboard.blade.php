@extends('panel.layouts.master')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center text-primary">مرحبًا بك مدير الإدارة</h1>

        <div class="list-group">
            <a href="{{ route('admin_manager.tasks.index') }}" class="list-group-item list-group-item-action d-flex align-items-center p-3 bg-info text-white rounded shadow-lg hover-shadow-lg">
                <i class="menu-icon tf-icons bx bx-task me-3 fs-4"></i>
                <div class="text-truncate">المهام الخاصة بي</div>
            </a>
        </div>
    </div>
@endsection
