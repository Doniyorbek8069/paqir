<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-staff" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Insonlar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-staff" class="nav-content collapse {{ request()->routeIs('admin.staff.*' ) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.staff.index') }}">
              <i class="bi bi-circle"></i><span>Insonlar</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.staff.types') }}">
              <i class="bi bi-circle"></i><span>Toifalar</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>


    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-operation" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Amallar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-operation" class="nav-content collapse {{ request()->routeIs('admin.operation.*' ) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.operation.index') }}">
              <i class="bi bi-circle"></i><span>Amallar</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.operation.incomes') }}">
              <i class="bi bi-circle"></i><span>Kirimlar Tarixi</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.operation.outcomes') }}">
              <i class="bi bi-circle"></i><span>Chiqimlar Tarixi</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>


    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-product" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Mahsulotlar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-product" class="nav-content collapse {{ request()->routeIs('admin.product.*' ) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.product.index') }}">
              <i class="bi bi-circle"></i><span>Mahsulotlar</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

    
  </aside><!-- End Sidebar-->
