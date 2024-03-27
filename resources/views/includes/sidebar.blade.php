<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('admin.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{route('admin.faq')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
                    FAQ
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                @can('admin')
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('users.index')}}">All Users</a>
                            <a class="nav-link" href="{{route('users-admin.index2')}}">All Users BC</a>
                            <a class="nav-link" href="{{route('users.create')}}">Create User</a>
                        </nav>
                    </div>
                @endcan
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPosts"
                   aria-expanded="false" aria-controls="collapseLayoutsPosts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-message"></i></div>
                    Posts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsPosts" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('posts.index')}}">All Posts</a>
                        <a class="nav-link" href="{{route('posts.create')}}">Create Post</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsCategories"
                   aria-expanded="false" aria-controls="collapseLayoutsCategories">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-message"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsCategories" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('categories.index')}}">All Categories</a>
                        <a class="nav-link" href="{{route('categories.create')}}">Create Category</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsComments"
                   aria-expanded="false" aria-controls="collapseLayoutsComments">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                    Comments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsComments" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('comments.index')}}">All Comments</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsProducts"
                   aria-expanded="false" aria-controls="collapseLayoutsProducts">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsProducts" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('products.index')}}">All Products</a>
                        <a class="nav-link" href="{{route('products.create')}}">Create Product</a>
                        <a class="nav-link" href="{{route('productcategories.index')}}">All Product Categories</a>
                        <a class="nav-link" href="{{route('productcategories.create')}}">Create Product Category</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsBrands"
                   aria-expanded="false" aria-controls="collapseLayoutsBrands">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-hashnode"></i></div>
                    Brands
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsBrands" aria-labelledby="headingOne"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('brands.index')}}">All Brands</a>
                        <a class="nav-link" href="{{route('brands.create')}}">Create Brand</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
