@extends('panel.layouts.master')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center text-primary">مرحبًا بك، @if(session('active_role') === 'programmer') مبرمجة @elseif(session('active_role') === 'tester') مختبرة @endif!</h1>
        
        <div class="alert alert-info text-center mb-4">
            <strong>تذكير:</strong> هذه الصفحة تحتوي على المهام الخاصة بك كـ 
            @if(session('active_role') === 'programmer') مبرمجة 
            @elseif(session('active_role') === 'tester') مختبرة 
            @endif.
        </div>

        <ul class="list-unstyled">
            <li class="menu-item mb-3">
                <a href="{{ route('programmer.tasks.index') }}" class="menu-link d-flex align-items-center p-3 bg-light rounded shadow-sm text-decoration-none">
                    <i class="menu-icon tf-icons bx bx-task fs-4 text-info me-3"></i>
                    <div class="text-truncate fs-5 text-dark" data-i18n="My Tasks">المهام الخاصة بي</div>
                </a>
            </li>
        </ul>
    </div>
@endsection
