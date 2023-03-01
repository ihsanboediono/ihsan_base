<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{  request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.company.*') || request()->routeIs('admin.vision.*') ||request()->routeIs('admin.mission.*') ||request()->routeIs('admin.history.*') || request()->routeIs('admin.partner.*') || request()->routeIs('admin.management.*') ? 'active sub-menu' : '' }}">
                    <a class="" data-toggle="collapse" href="#about" aria-expanded="{{  request()->routeIs('admin.company.*') || request()->routeIs('admin.vision.*') ||request()->routeIs('admin.mission.*') ||request()->routeIs('admin.history.*') || request()->routeIs('admin.partner.*') || request()->routeIs('admin.management.*') ? 'true' : 'false' }}">
                        <i class="fas fa-info-circle"></i>
                        <p>Tentang Pt. BASE</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{  request()->routeIs('admin.company.*') || request()->routeIs('admin.vision.*') ||request()->routeIs('admin.mission.*') ||request()->routeIs('admin.history.*') || request()->routeIs('admin.partner.*') || request()->routeIs('admin.management.*') ? 'show' : '' }}" id="about">
                        <ul class="nav nav-collapse">
                            <li class="{{  request()->routeIs('admin.company.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.company.index') }}">
                                    <span class="sub-item">Profil Perusahaan</span>
                                </a>
                            </li>
                            <li class="{{  request()->routeIs('admin.vision.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.vision.index') }}">
                                    <span class="sub-item">Visi</span>
                                </a>
                            </li>
                            <li class="{{  request()->routeIs('admin.mission.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.mission.index') }}">
                                    <span class="sub-item">Misi</span>
                                </a>
                            </li>
                            
                            <li class="{{  request()->routeIs('admin.client.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.client.index') }}">
                                    <span class="sub-item">Client</span>
                                </a>
                            </li>
                            <li class="{{  request()->routeIs('admin.partner.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.partner.index') }}">
                                    <span class="sub-item">Partner</span>
                                </a>
                            </li>
                            <li class="{{  request()->routeIs('admin.history.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.history.index') }}">
                                    <span class="sub-item">Sejarah</span>
                                </a>
                            </li>
                            <li  class="{{  request()->routeIs('admin.management.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.management.index') }}">
                                    <span class="sub-item">Susunan pengurus</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.product.*') ? 'active sub-menu' : '' }}">
                    <a class="" data-toggle="collapse" href="#products" aria-expanded="{{  request()->routeIs('admin.product.*') ? 'true' : 'false' }}">
                        <i class="fas fa-box-open"></i>
                        <p>Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{  request()->routeIs('admin.product.*') ? 'show' : '' }}" id="products">
                        <ul class="nav nav-collapse">
                            <li class="{{  request()->routeIs('admin.product.*') && !request()->routeIs('admin.product.category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.product.index') }}">
                                    <span class="sub-item">Produk</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.product.category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.product.category.index') }}">
                                    <span class="sub-item">Kategori Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.news.*') ? 'active sub-menu' : '' }}">
                    <a class="" data-toggle="collapse" href="#news" aria-expanded="{{  request()->routeIs('admin.news.*') ? 'true' : 'false' }}">
                        <i class="fas fa-newspaper"></i>
                        <p>Berita</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{  request()->routeIs('admin.news.*') ? 'show' : '' }}" id="news">
                        <ul class="nav nav-collapse">
                            <li class="{{  request()->routeIs('admin.news.*') && !request()->routeIs('admin.news.category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.news.index') }}">
                                    <span class="sub-item">Berita</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.news.category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.news.category.index') }}">
                                    <span class="sub-item">Kategori Berita</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.project.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.project.index') }}">
                        <i class="fas fa-handshake"></i>
                        <p>Proyek</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.career.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.career.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Karir</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.service.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.service.index') }}">
                        <i class="fas fa-hand-holding-heart"></i>
                        <p>Layanan</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.report.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.report.index') }}">
                        <i class="far fa-clipboard"></i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>
                
                <li class="nav-item {{  request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact.index') }}">
                        <i class="fas fa-phone"></i>
                        <p>Kontak Kami</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.video.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.video.index') }}">
                        <i class="fas fa-video"></i>
                        <p>Video</p>
                    </a>
                </li>

                <li class="nav-item {{  request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->