 <div class="offcanvas offcanvas-start" tabindex="-1" id="navOffcanvas">
     <script>
         const navTarget = 'target';
         $(function() {
             $(`.nav-${navTarget} b`).addClass('text-danger');
         });
     </script>
     <div class="offcanvas-body">
         <ul class="list-group list-group-flush">
             <li class="list-group-item nav-dashboard">
                 <a class="link-dark d-block" href="/">
                     <i class="bi bi-speedometer text-secondary me-2"></i><b>Dashboard</b>
                 </a>
             </li>

             <li class="list-group-item nav-news">
                 <a class="link-dark d-block" href="/categories/">
                     <i class="bi bi-grid text-secondary me-2"></i><b>Categories</b>
                 </a>
             </li>

             <li class="list-group-item nav-customers">
                 <a class="link-dark d-block" href="/subcategories/">
                     <i class="bi bi-grid-3x3-gap text-secondary me-2"></i><b>Sub Categories</b>
                 </a>
             </li>

             <li class="list-group-item nav-articles">
                 <a class="link-dark d-block" href="/products/">
                     <i class="bi bi-box-seam text-secondary me-2"></i><b>Products</b>
                 </a>
             </li>

             <li class="list-group-item nav-articles">
                 <a class="link-dark d-block" href="/orders/">
                     <i class="bi bi-truck text-secondary me-2"></i><b>Orders</b>
                 </a>
             </li>


         </ul>
     </div>
     <div class="d-flex">
         <a href="/profile" class="d-block p-3 flex-grow-1 border-top rounded-0 link-dark">
             <i class="bi bi-person-circle text-warning me-2"></i>
             <b>{{ auth()->user()->name }}</b>
         </a>
         <form action="{{ route('logout') }}" method="post" class="d-block p-2 border-top border-start rounded-0">
             @csrf
             <button type="submit" class="btn btn-outline-primary"><i class="bi bi-power text-danger"></i></button>
         </form>
     </div>
 </div>
