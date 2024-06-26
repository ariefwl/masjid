<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Route::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link {{ Route::is('kelompok.*') ? '' : 'collapsed' }}"" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="master-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>            
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>{{ (Auth::user()->unit == '2')?'Pengurus UPZ':'Pengurus Takmir' }}</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Inventaris</span>
            </a>
          </li>
          <li>
            <a class="{{ Route::is('kelompok.*') ? 'active' : '' }}" href="{{ route('kelompok.index'); }}">
              <i class="bi bi-circle"></i><span>Kelompok</span>
            </a>
          </li>
        </ul>
      </li><!-- End Master Data Nav -->

      @if (Auth::user()->unit == '3')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#qurban-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Qurban</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="qurban-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a class="{{ Route::is('hewan.*') ? 'active' : '' }}" href="{{ url('hewan'); }}">
                <i class="bi bi-circle"></i><span>Hewan Qurban</span>
              </a>
            </li>
            <li>
              <a class="{{ Route::is('shohibul.*') ? 'active' : '' }}" href="{{ route('shohibul.index'); }}">
                <i class="bi bi-circle"></i><span>Shohibul Qurban</span>
              </a>
            </li>
            <li>
              <a class="{{ Route::is('penerima.*') ? 'active' : '' }}" href="{{ route((Auth::user()->unit == '2')?'mustahik':'penerima.index') }}">
                <i class="bi bi-circle"></i><span>{{ (Auth::user()->unit == '2')?'Mustahik':'Penerima Qurban' }}</span>
              </a>
            </li>
            <li>
              <a class="{{ Route::is('kasQurban.*') ? 'active' : '' }}" href="{{ route((Auth::user()->unit == '2')?'kasZakat.index':'kasQurban.index') }}">
                <i class="bi bi-circle"></i><span>{{ (Auth::user()->unit == '2')?'Kas Zakat':'Kas Qurban' }}</span>
              </a>
            </li>
          </ul>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#zakat-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-basket"></i><span>Zakat</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="zakat-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a class="" href="{{ url('zakat') }}">
                <i class="bi bi-circle"></i><span>ZIS</span>
              </a>
            </li>
            <li>
              <a href="{{ url('beras') }}">
                <i class="bi bi-circle"></i><span>Stock Beras</span>
              </a>
            </li>
          </ul>
        </li><!-- End Zakat Nav -->
      @endif
        
      


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#keu-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="keu-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Kas</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>Stock Beras</span>
            </a>
          </li>
        </ul>
      </li><!-- End Transaksi Keuangan Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="blog-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Artikel</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse">
          <i class="bi bi-gear"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="setting-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a class="{{ Route::is('profiles.*') ? 'active' : '' }}" href="{{ route('profiles.create') }}">
              <i class="bi bi-circle"></i><span>Profile</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>User</span>
            </a>
          </li>
          <li>
            <a href="{{ url('bagian') }}">
              <i class="bi bi-circle"></i><span>Bagian</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

  </aside><!-- End Sidebar-->