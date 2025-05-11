@extends('panel.layouts.master')

@section('content')
    <h1 class="mb-4">Welcome admin-manager</h1>
    <li class="menu-item">
        <a href="{{ route('admin_manager.tasks.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-task"></i>
          <div class="text-truncate" data-i18n="My Tasks">المهام الخاصة بي</div>
        </a>
      </li>
@endsection
