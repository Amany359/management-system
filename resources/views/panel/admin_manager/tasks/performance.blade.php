@extends('panel.layouts.master')

@section('title', 'تحليل الأداء')

@section('content')
<div class="card">
  <div class="card-header"><h5>تحليل أداء الموظفين</h5></div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>الموظف</th>
          <th>عدد المهام المنجزة</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->completed_tasks_count }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
