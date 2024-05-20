<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <?php include_once('./include/head.php') ?>
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
        <?php include_once('./include/sidebar.php') ?>

        <div class="container-fluid" data-ng-app="myApp" data-ng-controller="myCtrl">


        </div>
    </div>

    <footer class="py-2 bg-dark text-center text-secondary mt-4 dir-rtl small font-monospace">
        <small>ver 1.4.61 by
            <a href="http://yottaline.com" class="link-secondary">sallahnow</a></small>
        <a href="#page-top" class="link-light bg-dark border-0"><i class="bi bi-arrow-up-short"></i></a>
    </footer>

    <!--  -->

    <script>
    var scope, limit = 14,
        app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

    app.controller('myCtrl', function($scope) {
        $('.loading-spinner').hide();
        $scope.statusObject = {
            name: ['غير مفعل', 'مفعل'],
            color: ['danger', 'success']
        };
        $scope.noMore = false;
        $scope.loading = false;
        $scope.q = '';
        $scope.orderUpdate = false;
        $scope.orders = [];
        $scope.last_id = 0;
        $scope.jsonParse = (str) => JSON.parse(str);
        $scope.dataLoader = function(reload = false) {
            if (reload) {
                $scope.orders = [];
                $scope.last_id = 0;
                $scope.noMore = false;
            }

            if ($scope.noMore) return;
            $scope.loading = true;
            $('.loading-spinner').show();

            $.get("http://127.0.0.1:8000/orders/order/1", function(data) {
                $('.loading-spinner').hide();
                var ln = data.length;
                $scope.$apply(() => {
                    $scope.loading = false;
                    if (ln) {
                        $scope.noMore = ln < limit;
                        $scope.orders = data;
                        console.log(data)
                        $scope.last_id = data[ln - 1].order_id;
                    }
                });
            }, 'json');

        }


        $scope.dataLoader();
        scope = $scope;
    });

    $(function() {
        $('#nvSearch').on('submit', function(e) {
            e.preventDefault();
            scope.$apply(() => scope.q = $(this).find('input').val());
            scope.dataLoader(true);
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() >= ($(document).height() - $(window).height() - 80) &&
                !scope
                .loading) scope.dataLoader();
        });
    });


    $(function() {
        $('#edit_active').on('click', function(e) {
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
            }).done(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                if (response.status) {
                    toastr.success('تم تغير حالة بنجاح');
                    $('#edit_active').modal('hide');
                    scope.$apply(() => {
                        if (scope.updateUser === false) {
                            scope.products.unshift(response.data);
                            scope.dataLoader(true);
                        } else {
                            scope.products[scope.updateUser] = response.data;
                            scope.dataLoader(true);
                        }
                    });
                } else toastr.error(response.message);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                toastr.error(response.message);
                controls.log(jqXHR.responseJSON.message);
                $('#useForm').modal('hide');
            }).always(function() {
                spinner.hide();
                controls.prop('disabled', false);
            });

        })
    })
    </script>
</body>

</html>