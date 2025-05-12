@extends('panel.layouts.master')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center fw-bold text-primary">لوحة تحكم مدير ضمان الجودة (QA Manager)</h3>

    <div class="row justify-content-center">
        <!-- إدارة المهام -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('qa_manager.tasks.index') }}" class="card bg-gradient-primary text-white text-center shadow p-4 text-decoration-none">
                <div class="card-body">
                    <i class="bx bx-task" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">إدارة مهام التيسترز</h5>
                    <p class="mb-0">عرض، اعتماد، وجدولة المهام</p>
                </div>
            </a>
        </div>

        <!-- المهام المعتمدة -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('qa_manager.tasks.index', ['status' => 'approved']) }}" class="card bg-success text-white text-center shadow p-4 text-decoration-none">
                <div class="card-body">
                    <i class="bx bx-check-circle" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">المهام المعتمدة</h5>
                    <p class="mb-0">عرض المهام التي تم اعتمادها</p>
                </div>
            </a>
        </div>

        <!-- إضافة مهمة (اختياري) -->
        <div class="col-md-4 mb-4">
            <a href="#" class="card bg-info text-white text-center shadow p-4 text-decoration-none">
                <div class="card-body">
                    <i class="bx bx-plus-circle" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">إضافة مهمة جديدة</h5>
                    <p class="mb-0">إنشاء مهمة وإسنادها لموظف</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
