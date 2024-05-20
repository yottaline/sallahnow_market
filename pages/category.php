<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <?php include_once('../include/head.php') ?>
    <script>
    if (!retailer) {
        window.location.href = " ./account/login.php"
    }
    </script>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-2 fixed-top">
        <div class="d-flex w-100 align-items-center">
            <div class="me-auto">
                <a class="h5 bi bi-list link-light p-2 m-0 me-3" role="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navOffcanvas" aria-controls="navOffcanvas"></a>
                <a class="navbar-brand fw-bold" href="" id="storeName"></a>
            </div>
        </div>
    </nav>
    <div id="wrapper">

        <?php include_once('../include/sidebar.php') ?>

        <div class="container-fluid" data-ng-app="myApp" data-ng-controller="myCtrl">
            <div class="row">
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="card card-box">
                        <div class="card-body">

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-8 col-lg-9">
                    <div class="card card-box">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title fw-semibold pt-1 me-auto mb-3 text-uppercase">
                                    <span class="loading-spinner spinner-border spinner-border-sm text-warning me-2"
                                        role="status"></span><span>CATEGORIES</span>
                                </h5>
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-circle bi bi-plus-lg"
                                        data-ng-click="setCategory(false)"></button>
                                    <button type="button" class="btn btn-outline-dark btn-circle bi bi-arrow-repeat"
                                        data-ng-click="dataLoader(true)"></button>
                                </div>
                            </div>

                            <div data-ng-if="list.length" class="table-responsive">
                                <table class="table table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Category Name AR</th>
                                            <th class="text-center">Category Name EN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-ng-repeat="category in list track by $index">
                                            <td data-ng-bind="category.category_id"
                                                class="text-center small font-monospace text-uppercase"></td>
                                            <td class="text-center" data-ng-bind="jsonParse(category.category_name).ar">
                                            </td>
                                            <td class="text-center" data-ng-bind="jsonParse(category.category_name).en">
                                            </td>
                                            <td class="col-fit">
                                                <button class="btn btn-outline-primary btn-circle bi bi-pencil-square"
                                                    data-ng-click="setCategory($index)"></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center text-secondary py-5">
                                <div data-ng-if="loading">
                                    <span class="loading-spinner spinner-border spinner-border-sm text-secondary me-2"
                                        role="status"></span>
                                    <span>Loading...</span>
                                </div>

                                <div data-ng-if="list.length && noMore">
                                    No Further Data
                                </div>

                                <div data-ng-if="!loading && !list.length">
                                    <i class="bi bi-exclamation-circle display-3"></i>
                                    <h5>No Data</h5>
                                </div>
                                <script>
                                $(function() {
                                    $(window).scroll(function() {
                                        if ($(window).scrollTop() >= ($(document).height() - $(window)
                                                .height() - 80) &&
                                            !scope.loading && !scope.noMore) scope.dataLoader();
                                    });
                                });
                                </script>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="categoryForm" tabindex="-1" role="dialog" aria-labelledby="categoryFormLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="POST" action="http://127.0.0.1:8000/api/categories/add_category">
                                <input data-ng-if="updateCategory !== false" type="hidden" name="_method" value="put">
                                <input type="hidden" name="cate_id" id="CateId"
                                    data-ng-value="list[updateCategory].category_id">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="categoriesName">
                                                Categiry Name AR<b class="text-danger">&ast;</b></label>
                                            <input type="text" class="form-control" name="name_ar" required
                                                data-ng-value="jsonParse(list[updateCategory].category_name).ar"
                                                id="categoriesName" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="categoriesName">
                                                Categiry Name EN<b class="text-danger">&ast;</b></label>
                                            <input type="text" class="form-control" name="name_en" required
                                                data-ng-value="jsonParse(list[updateCategory].category_name).en"
                                                id="categoriesName" />
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-secondary me-auto"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
            $('#categoryForm form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this),
                    formData = new FormData(this),
                    action = form.attr('action'),
                    method = form.attr('method'),
                    controls = form.find('button, input'),
                    spinner = $('#locationModal .loading-spinner');
                spinner.show();
                controls.prop('disabled', true);
                $.ajax({
                    url: action,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    headers: {
                        'Authorization': `Bearer ${retailer.token}`
                    },
                }).done(function(response, textStatus, jqXHR) {
                    if (response.status) {
                        toastr.success('Data processed successfully');
                        $('#categoryForm').modal('hide');
                        scope.$apply(() => {
                            if (scope.updateCategory === false) {
                                scope.list = response
                                    .data.data;
                                scope.dataLoader();
                                categoyreClsForm()
                            } else {
                                scope.list[scope
                                    .updateCategory] = response.data;
                            }
                        });
                    } else toastr.error("Error");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // error msg
                }).always(function() {
                    spinner.hide();
                    controls.prop('disabled', false);
                });
            })

            function categoyreClsForm() {
                $('#CateId').val('');
                $('#categoriesName').val('');
            }
            </script>


        </div>
    </div>

    <footer class="py-2 bg-dark text-center text-secondary mt-4 dir-rtl small font-monospace">
        <small>ver 1.4.61 by
            <a href="http://yottaline.com" class="link-secondary">sallahnow</a></small>
        <a href="#page-top" class="link-light bg-dark border-0"><i class="bi bi-arrow-up-short"></i></a>
    </footer>

    <!--  -->

    <script>
    var scope,
        app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

    app.controller('myCtrl', function($scope) {
        $('.loading-spinner').hide();
        $scope.noMore = false;
        $scope.loading = false;
        $scope.q = '';
        $scope.updateCategory = false;
        $scope.list = [];
        $scope.last_id = 0;

        $scope.jsonParse = (str) => JSON.parse(str);
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
                limit: limit,
                token: retailer.token
            };

            $.post("http://127.0.0.1:8000/api/categories/load_categories", request, function(data) {
                $('.loading-spinner').hide();
                var ln = data.data.length;
                $scope.$apply(() => {
                    $scope.loading = false;
                    if (ln) {
                        $scope.noMore = ln < limit;
                        $scope.list = data.data;
                        console.log(data)
                        $scope.last_id = data.data[ln - 1].category_id;
                    }
                });
            }, 'json');
        }

        $scope.setCategory = (indx) => {
            $scope.updateCategory = indx;
            $('#categoryForm').modal('show');
        };
        $scope.dataLoader();
        scope = $scope;
    });

    $('#nvSearch').on('submit', function(e) {
        e.preventDefault();
        scope.$apply(() => scope.q = $(this).find('input').val());
        scope.dataLoader(true);
    });
    </script>
</body>

</html>