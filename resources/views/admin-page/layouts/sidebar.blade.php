<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">TEST</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">T</a>
      </div>
      <ul class="sidebar-menu">
       
        <li class="menu-header">Starter</li>
        
        <li class="{{ request()->is('admin') ? 'active' : '' }}"><a class="nav-link " href="/admin"><i class="fas fa-users"></i> <span>Admin</span></a></li>
        <li class="{{ request()->is('pegawai') ? 'active' : '' }}"><a class="nav-link " href="/pegawai"><i class="fas fa-users"></i> <span>Pegawai</span></a></li>
        <li class="{{ request()->is('cuti') ? 'active' : '' }}"><a class="nav-link " href="/cuti"><i class="fas fa-th-large"></i> <span>Cuti</span></a></li>
        <li class="{{ request()->is('admin/e') ? 'active' : '' }}">
          <a class="nav-link" href="/admin/edit/{{ Auth::user()->id }}">
              <i class="fas fa-user"></i>
              <span>Edit Profil</span>
          </a>
      </li>
      
        <li class=""><a class="nav-link " href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </aside>
  </div>