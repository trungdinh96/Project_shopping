<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
      <img src="{{BASE_URL}}AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN SHOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{BASE_URL}}AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
         
          @can('category-list')
          <li class="nav-item">
            <a href="{{route('admin.category.list')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category product
                
              </p>
            </a>
          </li>
          @endcan

          @can('menu-list')
          <li class="nav-item">
            <a href="{{route('admin.menu.list')}}" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Menus
                
              </p>
            </a>
          </li>
          @endcan
         
          @can('product-list')
          <li class="nav-item">
            <a href="{{route('admin.product.list')}}" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
                
              </p>
            </a>
          </li>
          @endcan
         
          @can('user-list')
          <li class="nav-item">
            <a href="{{route('admin.user.list')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                
              </p>
            </a>
          </li>
          @endcan
          
          @can('roles-list')
          <li class="nav-item">
            <a href="{{route('admin.permission.list')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Permission
                
              </p>
            </a>
          </li>
          @endcan
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>