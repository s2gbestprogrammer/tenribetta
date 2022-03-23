<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/">TENRIBETA</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">TRB</a>
      </div>
      <ul class="sidebar-menu">
            <li class="menu-header">Master Data</li>
            <li class="{{ Request::is('anggota*')?'active':'' }}"><a class="nav-link" href="{{route('anggota.index')}}"><i class="fas fa-users"></i> <span>Anggota </span></a></li>
            <li class="{{ Request::is('laporan*')?'active':'' }}"><a class="nav-link" href="{{route('laporan')}}"><i class="fas fa-book-open"></i> <span>Laporan </span></a></li>

            <li class="{{ Request::is('logout*')?'active':'' }}"><a class="nav-link" href="{{route('logout')}}"><i class="fas fa-exit"></i> <span>Keluar </span></a></li>


    </aside>
</div>
