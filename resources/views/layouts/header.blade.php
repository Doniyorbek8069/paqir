<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Asosiy Sahifa</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <b> </b>
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <button type="button"  class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#modalstore">
                <i class="bi bi-person"></i>
                <span>Mening Profilim</span>
              </button>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a href="{{route('logout')}}" class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Chiqish</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
{{--   <div class="modal fade" id="modalstore" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ route('operator.update-user',['user' => Auth::guard('web')->user()->id]) }}" method="POST">
      @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Ma'lumotlarni Yangilash</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Ism</span>
                    <input type="text" class="form-control" aria-describedby="addon-wrapping" name="name">
                </div>
                <p></p>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Familiya</span>
                    <input type="text" class="form-control" aria-describedby="addon-wrapping" name="surname">
                </div>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">Parol</span>
                  <input type="text" class="form-control" aria-describedby="addon-wrapping" name="password">
              </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
    </form>
    </div>
</div> --}}
