<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Si-</strong>Awalku</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="mt-3 p-1 mb-3 d-flex bg-secondary rounded">
          <img src='https://iraisenew.uin-suska.ac.id//~include/iraise/Logo%20UIN%20SUSKA%20Riau.svg' class="img-fluid" alt="User Image">
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
            <a href="{{route('perkuliahan.index')}}" class="nav-link bg-primary">
                <i class="fas fa-table nav-icon"></i>
                <p>Jadwal Perkuliahan</p>
            </a>
            </li>
            <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-2">
              <li class="nav-item">
                <a href="{{route('dosen.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dosen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('matakuliah.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matakuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ruangkelas.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruangan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>