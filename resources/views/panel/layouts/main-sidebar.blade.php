<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo py-3 px-4">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- SVG logo remains unchanged -->
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2 text-uppercase">sneat</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <!-- Logout Link -->
  <li class="menu-item mt-4">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
      <i class="menu-icon tf-icons bx bx-log-out"></i>
      <div class="text-truncate">تسجيل الخروج</div>
    </a>
  </li>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>

  <!-- Menu Items -->
  <ul class="menu-inner py-2">
    <!-- Dashboards -->
    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-transfer"></i>
        <div class="text-truncate">المعاملات</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('team_leader.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user-check"></i>
        <div class="text-truncate">قائد الفريق</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('programmer.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-code"></i>
        <div class="text-truncate">المبرمج/التستر </div>
      </a>
    </li>

    <!-- QA Manager -->
    <li class="menu-item">
      <a href="{{ route('qa_manager.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-task"></i>
        <div class="text-truncate">مدير الجودة</div>
      </a>
    </li>

    <!-- Admin Manager Section -->
    <li class="menu-item has-sub">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate">مدير الإدارة</div>
      </a>
      <ul class="menu-sub">
         <li class="menu-item">
          <a href="{{ route('admin_manager.dashboard') }}" class="menu-link">
            <div class="text-truncate">رؤية كل المهام</div>
          </a>
        </li>

        <li class="menu-item">
          <a href="{{ route('admin_manager.tasks.index') }}" class="menu-link">
            <div class="text-truncate">رؤية كل المهام</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin_manager.tasks.performance') }}" class="menu-link">
            <div class="text-truncate">تحليل الأداء</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin_manager.tasks.weekly_report') }}" class="menu-link">
            <div class="text-truncate">تقرير الإنجاز الأسبوعي</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin_manager.logs.index') }}" class="menu-link">
            <div class="text-truncate">سجلات الأنشطة</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
