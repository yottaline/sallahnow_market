@extends('index')
@section('title', 'Products')
@section('search')
    <form id="nvSearch" role="search">
        <input type="search" name="q" class="form-control my-3 my-md-0 rounded-pill" placeholder="Search...">
    </form>
@endsection
@section('content')
    <div class="container-fluid" data-ng-app="myApp" data-ng-controller="myCtrl">
        <div class="row">
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card card-box">
                    <div class="card-body">
                        {{-- price --}}
                        <div class="mb-3">
                            <label for="filter-price">Price</label>
                            <input type="text" class="form-control" name="price" maxlength="24" id="filter-price"
                                required />
                        </div>
                        {{-- category --}}
                        <div class="mb-3">
                            <label>Categories</label>
                            <select id="filter-caetgories" class="form-select">
                                <option value="0">-- SELECT CATEEGOY NAME --</option>
                                <option data-ng-repeat="categoy in categories" data-ng-value="categoy.category_id"
                                    data-ng-bind="jsonParse(categoy.category_name)['en']">
                                </option>
                            </select>
                        </div>
                        {{-- subcategory --}}
                        <div class="mb-3">
                            <label>Sub categories</label>
                            <select id="filter-subcaetgories" class="form-select">
                                <option value="0">-- SELECT SUB CATEGORY NAME --</option>
                                <option data-ng-repeat="sub in subcategories" data-ng-value="sub.subcategory_id"
                                    data-ng-bind="jsonParse(sub.subcategory_name)['en']">
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-8 col-lg-9">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="d-flex">
                            <h5 class="card-title fw-semibold pt-1 me-auto mb-3 text-uppercase">
                                <span class="loading-spinner spinner-border spinner-border-sm text-warning me-2"
                                    role="status"></span><span>PRODUCTS</span>
                            </h5>
                            <div>
                                <button type="button" class="btn btn-outline-primary btn-circle bi bi-plus-lg"
                                    data-ng-click="setProduct(false)"></button>
                                <button type="button" class="btn btn-outline-dark btn-circle bi bi-arrow-repeat"
                                    data-ng-click="dataLoader(true)"></button>
                            </div>
                        </div>

                        <h5 data-ng-if="q" class="text-dark">Results of <span class="text-primary" data-ng-bind="q"></span>
                        </h5>

                        <div data-ng-if="list.length" class="table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Product Name</th>
                                        {{-- <th class="text-center">Store Name</th> --}}
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center">SubCategory Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-ng-repeat="product in list track by $index">
                                        <td data-ng-bind="product.product_code"
                                            class="text-center small font-monospace text-uppercase"></td>
                                        <td class="text-center" data-ng-bind="product.product_name"></td>
                                        {{-- <td class="text-center" data-ng-bind="product.store_name"></td> --}}
                                        <td class="text-center" data-ng-bind="jsonParse(product.category_name).en"></td>
                                        <td class="text-center" data-ng-bind="jsonParse(product.subcategory_name).en"></td>
                                        <td class="text-center" data-ng-bind="product.product_price"></td>
                                        <td class="text-center" data-ng-bind="product.product_disc"></td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-<%statusObject.color[product.product_show]%> rounded-pill font-monospace p-2"><%statusObject.name[product.product_show]%></span>

                                        </td>
                                        <td class="col-fit">
                                            <button class="btn btn-outline-success btn-circle bi bi-check"
                                                data-ng-click="editStatus($index)"></button>
                                            <button class="btn btn-outline-danger btn-circle bi bi-trash"
                                                data-ng-click="delete($index)"></button>
                                            <button class="btn btn-outline-primary btn-circle bi bi-pencil-square"
                                                data-ng-click="setProduct($index)"></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @include('layouts.loade')
                    </div>
                </div>
            </div>
        </div>

        @include('content.components.modal.products')

    </div>
@endsection

@section('js')
    <script>
        var scope,
            app = angular.module('myApp', [], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

        app.controller('myCtrl', function($scope) {
            $scope.statusObject = {
                name: ['Unavailable', 'available'],
                color: ['danger', 'success']
            };
            $('.loading-spinner').hide();
            $scope.noMore = false;
            $scope.loading = false;
            $scope.q = '';
            $scope.updateProduct = false;
            $scope.list = [];

            $scope.last_id = 0;
            $scope.jsonParse = (str) => JSON.parse(str);
            $scope.categories = <?= json_encode($categories) ?>;
            $scope.subcategories = <?= json_encode($subcategories) ?>;
            $scope.dataLoader = function(reload = false) {
                if (reload) {
                    $scope.list = [];
                    $scope.last_id = 0;
                    $scope.noMore = false;
                }

                if ($scope.noMore) return;
                $scope.loading = true;

                $('.loading-spinner').show();
                var request = {
                    q: $scope.q,
                    last_id: $scope.last_id,
                    price: $('#filter-price').val(),
                    category: $('#filter-caetgories').val(),
                    subcategory: $('#filter-subcaetgories').val(),
                    limit: limit,
                    _token: '{{ csrf_token() }}'
                };

                $.post("/products/load", request, function(data) {
                    $('.loading-spinner').hide();
                    var ln = data.length;
                    $scope.$apply(() => {
                        $scope.loading = false;
                        if (ln) {
                            $scope.noMore = ln < limit;
                            $scope.list = data;
                            console.log(data)
                            $scope.last_id = data[ln - 1].product_id;
                        }
                    });
                }, 'json');
            }

            $scope.setProduct = (indx) => {
                $scope.updateProduct = indx;
                $('#productForm').modal('show');
            };
            $scope.editStatus = (index) => {
                $scope.updateProduct = index;
                $('#edit_active').modal('show');
            };
            $scope.delete = (index) => {
                $scope.updateProduct = index;
                $('#delete_product').modal('show');
            };
            $scope.dataLoader();
            scope = $scope;
        });

        $('#nvSearch').on('submit', function(e) {
            e.preventDefault();
            scope.$apply(() => scope.q = $(this).find('input').val());
            scope.dataLoader(true);
        });

        $('#categoy').on('change', function() {
            var idState = this.value;
            $('#subcategoy').html('');
            $.ajax({
                url: '/products/get_subCategory/' + idState,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $.each(res, function(key, value) {
                        $('#subcategoy').append('<option id="class" value="' + value
                            .subcategory_id +
                            '">' + scope.jsonParse(value.subcategory_name).en + '</option>');
                    });
                }
            });
        });
    </script>
@endsection
