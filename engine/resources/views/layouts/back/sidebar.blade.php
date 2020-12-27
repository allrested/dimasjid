<aside class="side-nav scroll">
    <div class="smartphone-menu-trigger"><i class="dripicons-align-justify"></i></div>
    <div class="closeSideNav"><i class="dripicons-cross"></i></div>
    <ul class="side-nav-wrapper">
        <li class="brand">
            <a href="{{url('/admin')}}">
                <img src="{{asset('assets-front')}}/images/logo.png" alt="DPU logo" width="200px !important" >
            </a>
        </li>
        <hr>
        <li class="sideBox-section">SISTAMAS</li>
        <li class="sideBox-item">
            <a href="{{url('/admin')}}" class="{{Request::is('admin')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-home"></i>
                <span class="sideBox-item-name">Dashboard</span>
            </a>
        </li>

        <li class="sideBox-section">Penganggaran</li>

        <li class="sideBox-item">
            <a href="{{ route('anggaran.penerimaan.index')}}" class="{{Request::is('admin/anggaran/penerimaan*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-view-thumb"></i>
                <span class="sideBox-item-name">Penerimaan</span>
            </a>
        </li>
        <li class="sideBox-item">
        <a href="{{ route('anggaran.pengeluaran.index')}}" class="{{Request::is('admin/anggaran/pengeluaran*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-view-thumb"></i>
                <span class="sideBox-item-name">Pengeluaran</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('anggaran.saldo.index')}}" class="{{request()->is('admin/anggaran/saldo*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-stack"></i>
                <span class="sideBox-item-name">Saldo</span>
            </a>
        </li>

        <li class="sideBox-section">Master Data</li>
				<li class="sideBox-item" >
                    <a href="{{ route('akun.index')}}" class="{{request()->is('admin/akun*')  ? 'currentPage' : '' }}"
                        >                        
						<i class="sideBox-item-icon dripicons-stack"></i>
					    <span class="sideBox-item-name">Akun Rekening</span>
					</a>
				</li>
				<li class="sideBox-item" >
                    <a href="{{ route('users.index')}}" class="{{request()->is('admin/users*')  ? 'currentPage' : '' }}"
                        >                        
						<i class="sideBox-item-icon dripicons-stack"></i>
					    <span class="sideBox-item-name">Data Pengguna</span>
					</a>
				</li>
        @if (auth()->user()->role == 1 )
				<li class="sideBox-item">
                    <a href=
                    "{{ route('masjid.index')}}" class="{{request()->is('admin/masjid*')  ? 'currentPage' : '' }}"
                    >
						<i class="sideBox-item-icon dripicons-stack"></i>
					    <span class="sideBox-item-name">Data Masjid</span>
					</a>
				</li>
        <li class="sideBox-section">Content Management</li>
        
        <li class="sideBox-item">
            <a href="{{ route('banner.index') }}" class="{{Request::is('admin/banner*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-archive"></i>
                <span class="sideBox-item-name">Banner</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('announce.index')}}" class="{{Request::is('admin/announce*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-broadcast"></i>
                <span class="sideBox-item-name">Pengumuman</span>
            </a>
        </li>
         <li class="sideBox-item">
            <a href="{{ route('informasi-publik.index')}}" class="{{Request::is('admin/informasi-publik*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-information"></i>
                <span class="sideBox-item-name">Informasi Publik</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('berita.index')}}" class="{{Request::is('admin/berita*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-article"></i>
                <span class="sideBox-item-name">Berita</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('comments.index')}}" class="{{Request::is('admin/comments*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-message"></i>
                <span class="sideBox-item-name">Komentar</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('admin-kontak-kami.index')}}" class="{{Request::is('admin/kontak-kami*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-message"></i>
                <span class="sideBox-item-name">Pesan Masuk</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('agenda.index')}}" class="{{Request::is('admin/agenda*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-calendar"></i>
                <span class="sideBox-item-name">Agenda</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('gallery.index')}}" class="{{Request::is('admin/gallery*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-photo-group"></i>
                <span class="sideBox-item-name">Galeri</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('videos.index')}}" class="{{Request::is('admin/videos*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-media-play"></i>
                <span class="sideBox-item-name">Video</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{ route('links.index')}}" class="{{Request::is('admin/links*')  ? 'currentPage' : '' }}">
                <i class="sideBox-item-icon dripicons-link"></i>
                <span class="sideBox-item-name">Link Terkait</span>
            </a>
        </li>
        <li class="sideBox-item">
            <a href="{{url('/')}}" target="_blank">
                <i class="sideBox-item-icon dripicons-web"></i>
                <span class="sideBox-item-name">Halaman Beranda</span>
            </a>
        </li>
        @endif
    </ul>
</aside><!-- end .side-nav -->
