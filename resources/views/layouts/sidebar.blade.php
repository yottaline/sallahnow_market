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




             {{-- <li class="list-group-item nav-news">
                 <a class="link-dark d-block" href="/posts/post">
                     <i class="bi bi-file-post-fill text-secondary me-2"></i><b>Posts</b>
                 </a>
             </li>

             <li class="list-group-item nav-news">
                 <a class="link-dark d-block" href="/chats/">
                     <i class="bi bi-chat-left-text text-secondary me-2"></i><b>Chat</b>
                 </a>
             </li>

             <li class="list-group-item nav-support">
                 <a class="link-dark d-block" href="/customers/">
                     <i class="bi bi-person-vcard text-secondary me-2"></i><b>Customers</b>
                 </a>
             </li> --}}


             {{-- <li class="list-group-item">
                 <a class="link-dark d-block" data-bs-toggle="collapse" href="#paymentsCollapse" role="button"
                     aria-expanded="false" aria-controls="paymentsCollapse">
                     <i class="bi bi-wallet2 text-secondary me-2"></i><b>Finance</b>
                 </a>
                 <div class="collapse" id="paymentsCollapse">
                     <ul class="list-group list-group-flush">
                         <li class="list-group-item nav-subsc">
                             <a class="link-dark d-block" href="/subscriptions/">
                                 <i class="bi bi-cart-check text-secondary me-2"></i><b>Subscriptions</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/transactions/">
                                 <i class="bi bi-credit-card text-secondary me-2"></i><b>Transactions</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/points/">
                                 <i class="bi bi-ticket-perforated text-secondary me-2"></i><b>Points</b>
                             </a>
                         </li>
                     </ul>
                 </div>
                 <script>
                     const paymentsCollapse = new bootstrap.Collapse('#paymentsCollapse', {
                         toggle: false
                     });
                     if (['subsc', 'trans', 'refunds', 'promos'].includes(navTarget))
                         paymentsCollapse.show();
                 </script>
             </li> --}}

             {{-- <li class="list-group-item nav-users">
                 <a class="link-dark d-block" href="/users/">
                     <i class="bi bi-fingerprint
                     text-secondary me-2"></i><b>Users</b>
                 </a>
             </li> --}}



             {{-- <li class="list-group-item">
                 <a class="link-dark d-block" data-bs-toggle="collapse" href="#suuportCollapse" role="button"
                     aria-expanded="false" aria-controls="suuportCollapse">
                     <i class="bi bi-robot text-secondary me-2"></i><b>Supports</b>
                 </a>
                 <div class="collapse" id="suuportCollapse">
                     <ul class="list-group list-group-flush">
                         <li class="list-group-item nav-subsc">
                             <a class="link-dark d-block" href="/supports/">
                                 <i class="bi bi-clipboard-plus text-secondary me-2"></i><b>Categories</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/tickets/">
                                 <i class="bi bi-ticket-perforated text-secondary me-2"></i><b>Tickets</b>
                             </a>
                         </li>
                     </ul>
                 </div>
                 <script>
                     const suuportCollapse = new bootstrap.Collapse('#suuportCollapse', {
                         toggle: false
                     });
                     if (['subsc', 'trans', 'refunds', 'promos'].includes(navTarget))
                         suuportCollapse.show();
                 </script>
             </li> --}}

             {{-- <li class="list-group-item">
                 <a class="link-dark d-block" data-bs-toggle="collapse" href="#marketsItme" role="button"
                     aria-expanded="false" aria-controls="marketsItme">
                     <i class="bi bi-shop text-secondary me-2"></i><b>Markets</b>
                 </a>
                 <div class="collapse" id="marketsItme">
                     <ul class="list-group list-group-flush">
                         <li class="list-group-item nav-subsc">
                             <a class="link-dark d-block" href="/markets/retailers/">
                                 <i class="bi bi-person-vcard-fill text-secondary me-2"></i><b>Retailers</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/markets/stores/">
                                 <i class="bi bi-shop-window text-secondary me-2"></i><b>Stores</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/markets/categories/">
                                 <i class="bi bi-grid text-secondary me-2"></i><b>Categories</b>
                             </a>
                         </li>

                         <li class="list-group-item nav-trans">
                             <a class="link-dark d-block" href="/markets/subcategories/">
                                 <i class="bi bi-grid-3x3-gap text-secondary me-2"></i><b>Sub Categories</b>
                             </a>
                         </li>
                     </ul>
                 </div>
                 <script>
                     const marketsItme = new bootstrap.Collapse('#marketsItme', {
                         toggle: false
                     });
                     if (['subsc', 'trans', 'refunds', 'promos'].includes(navTarget))
                         marketsItme.show();
                 </script>
             </li> --}}



             {{-- <li class="list-group-item nav-support">
                 <a class="link-dark d-block" href="/settings/">
                     <i class="bi bi-gear text-secondary me-2"></i><b>Settings</b>
                 </a>
             </li> --}}
         </ul>
     </div>
     <div class="d-flex">
         <a href="{{ route('profile.edit') }}" class="d-block p-3 flex-grow-1 border-top rounded-0 link-dark">
             <i class="bi bi-person-circle text-warning me-2"></i>
             <b>{{ auth()->user()->name }}</b>
         </a>
         <form action="{{ route('logout') }}" method="post" class="d-block p-2 border-top border-start rounded-0">
             @csrf
             <button type="submit" class="btn btn-outline-primary"><i class="bi bi-power text-danger"></i></button>
         </form>
     </div>
 </div>
