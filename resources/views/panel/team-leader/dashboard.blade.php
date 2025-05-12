@extends('panel.layouts.master')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center fw-bold text-primary">لوحة تحكم قائد الفريق (Team Leader)</h3>

    <div class="row justify-content-center">
        <!-- إدارة المهام -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('team_leader.tasks.index') }}" class="card bg-gradient-primary text-white text-center shadow-lg p-4 text-decoration-none rounded">
                <div class="card-body">
                    <i class="bx bx-task" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">إدارة المهام</h5>
                    <p class="mb-0">عرض المهام الحالية، تعديلها، وحذفها</p>
                </div>
            </a>
        </div>

        <!-- إضافة مهمة -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('team_leader.tasks.create') }}" class="card bg-success text-white text-center shadow-lg p-4 text-decoration-none rounded">
                <div class="card-body">
                    <i class="bx bx-plus-circle" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">إضافة مهمة جديدة</h5>
                    <p class="mb-0">إنشاء مهمة جديدة وتعيينها للموظف المناسب</p>
                </div>
            </a>
        </div>

        <!-- المهام المعتمدة -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('team_leader.tasks.index', ['status' => 'approved']) }}" class="card bg-info text-white text-center shadow-lg p-4 text-decoration-none rounded">
                <div class="card-body">
                    <i class="bx bx-check-circle" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 fw-bold">المهام المعتمدة</h5>
                    <p class="mb-0">عرض المهام التي تم اعتمادها</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- إضافة تأثيرات عند التمرير -->
<style>
    .card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }
</style>
@endsection
