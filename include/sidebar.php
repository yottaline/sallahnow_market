<div class="offcanvas offcanvas-start" tabindex="-1" id="navOffcanvas">
    <script>
    const navTarget = 'target';
    document.getElementById('storeName').textContent = retailer.store_name + ' store';
    // $('#').val();/
    $(function() {
        $(`.nav-${navTarget} b`).addClass('text-danger');
    });
    </script>
    <div class="offcanvas-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item nav-dashboard">
                <a class="link-dark d-block" href="/">
                    <i class="bi bi-truck text-secondary me-2"></i><b>Orders</b>
                </a>
            </li>

            <li class="list-group-item nav-articles">
                <a class="link-dark d-block" href="./pages/category.php">
                    <i class="bi bi-tags text-secondary me-2"></i><b>Categories</b>
                </a>
            </li>


            <li class="list-group-item nav-articles">
                <a class="link-dark d-block" href="/compatibilities/">
                    <i class="bi bi-border-style text-secondary me-2"></i><b>Subcategories</b>
                </a>
            </li>

            <li class="list-group-item nav-news">
                <a class="link-dark d-block" href="/technicians/">
                    <i class="bi bi-box text-secondary me-2"></i><b>Products</b>
                </a>
            </li>

            <!-- <li class="list-group-item nav-customers">
                <a class="link-dark d-block" href="/centers/">
                    <i class="bi bi-globe-central-south-asia text-secondary me-2"></i><b>Centers</b>
                </a>
            </li> -->



            <li class="list-group-item nav-support">
                <a class="link-dark d-block" href="/settings/">
                    <i class="bi bi-gear text-secondary me-2"></i><b>Settings</b>
                </a>
            </li>
        </ul>
    </div>
    <div class="d-flex">
        <a href="#" class="d-block p-3 flex-grow-1 border-top rounded-0 link-dark">
            <!-- <i class="bi bi-person-circle text-warning me-2"></i> -->
            <b id="storeName"></b>
        </a>
    </div>
</div>