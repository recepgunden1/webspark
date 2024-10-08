<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#slider-menu" aria-expanded="false" aria-controls="slider-menu">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="slider-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.index')}}">Slider'lar</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.create')}}">Slider Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category-menu" aria-expanded="false" aria-controls="category-menu">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kategori</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.index')}}">Kategoriler</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.create')}}">Kategori Ekle</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product-menu" aria-expanded="false" aria-controls="product-menu">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Ürünler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.product.index')}}">Ürünler</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.product.create')}}">Ürün Ekle</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.about.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Hakkımızda</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.order.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Siparişler</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.contact.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Gelen Kutusu</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.setting.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Site Ayarları</span>
            </a>
        </li>

    </ul>
</nav>
