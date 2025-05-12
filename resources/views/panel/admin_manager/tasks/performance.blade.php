@extends('panel.layouts.master')

@section('title', 'تحليل أداء المبرمجين والتيسترات')

@section('content')
<div class="card">
    <div class="card-header"><h5>تحليل أداء المبرمجين والتيسترات</h5></div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>الموظف</th>
                    <th>عدد المهام المنجزة كمبرمج</th>
                    <th>عدد المهام المنجزة كتيستر</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->completed_programmer_tasks }}</td>
                    <td>{{ $user->completed_tester_tasks }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
