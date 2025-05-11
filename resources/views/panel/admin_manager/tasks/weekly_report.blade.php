@extends('panel.layouts.master')

@section('title', 'تقرير الإنجاز الأسبوعي')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>تقرير الإنجاز من {{ $start->format('Y-m-d') }} إلى {{ $end->format('Y-m-d') }}</h5>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>اسم المهمة</th>
          <th>الموظف</th>
          <th>تاريخ الإنجاز</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tasks as $task)
        <tr>
          <td>{{ $task->title }}</td>
          <td>{{ $task->assignedTo->name ?? '-' }}</td>
          <td>{{ $task->updated_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
