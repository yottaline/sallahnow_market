<div class="modal fade" id="productForm" tabindex="-1" role="dialog" aria-labelledby="productFormLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form id="cenForm" method="post" action="/products/submit">
                    {{-- enctype="multipart/form-data" --}}
                    @csrf
                    <input data-ng-if="updateProduct !== false" type="hidden" name="_method" value="put">
                    <input type="hidden" name="product_id" data-ng-value="list[updateProduct].product_id">
                    <div class="row">
                        {{-- name --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="productName">Name<b class="text-danger">&ast;</b></label>
                                <input type="text" class="form-control" name="name"
                                    data-ng-value="list[updateProduct].product_name" id="productName" required />
                            </div>
                        </div>

                        {{-- category --}}
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Categories<b class="text-danger">&ast;</b></label>
                                <select name="categoy" id="categoy" class="form-select" required>
                                    <option value="default">-- SELECT CATEGORY NAME --</option>
                                    <option data-ng-repeat="categoy in categories" data-ng-value="categoy.category_id"
                                        data-ng-bind="jsonParse(categoy.category_name)['en']">
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- subcategory --}}
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Subcategories<b class="text-danger">&ast;</b></label>
                                <select name="subcategoy" id="subcategoy" class="form-select" required>
                                    <option value="default">-- SELECT SUB CATEGORY NAME --</option>
                                </select>
                            </div>
                        </div>

                        {{-- price --}}
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="price">Price<b class="text-danger">&ast;</b></label>
                                <input type="text" class="form-control" name="price" maxlength="24"
                                    data-ng-value="list[updateProduct].product_price" id="price" required />
                            </div>
                        </div>


                        {{--  --}}
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="Discount">Discount<b class="text-danger">&ast;</b></label>
                                <input type="text" class="form-control" name="disc" maxlength="24"
                                    data-ng-value="list[updateProduct].product_disc" id="Discount" required />
                            </div>
                        </div>

                        {{-- images --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="image" class="me-2">Images <b class="text-danger">&ast;</b> <span
                                        class="text-warning-emphasis">You can
                                        add more than
                                        one image</span></label>
                                <input type="file" class="form-control" name="image[]" id="phone" required
                                    multiple />
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="description">Description <b class="text-danger">&ast;</b></label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="7" required><%list[updateProduct].product_desc%></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex">
                        <button type="button" class="btn btn-outline-secondary me-auto btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                    </div>
                </form>
                <script>
                    $('#cenForm').on('submit', e => e.preventDefault()).validate({
                        rules: {
                            price: {
                                digits: true
                            },
                            disc: {
                                digits: true
                            },
                        },
                        submitHandler: function(form) {
                            console.log(form);
                            var formData = new FormData(form),
                                action = $(form).attr('action'),
                                method = $(form).attr('method');

                            $(form).find('button').prop('disabled', true);
                            $.ajax({
                                url: action,
                                type: method,
                                data: formData,
                                processData: false,
                                contentType: false,
                            }).done(function(data, textStatus, jqXHR) {
                                var response = JSON.parse(data);
                                if (response.status) {
                                    toastr.success('Data processed successfully');
                                    $('#productForm').modal('hide');
                                    scope.$apply(() => {
                                        if (scope.updateProduct === false) {
                                            scope.list.unshift(response.data);
                                            clsForm();
                                            // scope.dataLoader(true);
                                        } else {
                                            scope.list[scope.updateProduct] = response.data;
                                            // scope.dataLoader(true);
                                        }
                                    });
                                } else toastr.error(response.message);
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                toastr.error("error");
                            }).always(function() {
                                $(form).find('button').prop('disabled', false);
                            });
                        }
                    });

                    function clsForm() {
                        $('#productName').val('');
                        $('#price').val('');
                        $('#Discount').val('');
                        $('#image').val('');
                        $('#description').val('');
                    };
                </script>
            </div>
        </div>
    </div>
</div>

{{-- edit status of product --}}
<div class="modal fade modal-sm" id="edit_active" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/products/change_status">
                    @csrf @method('PUT')
                    <input hidden data-ng-value="list[updateProduct].product_id" name="product_id">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status"
                                value="1" ng-checked="+list[updateProduct].product_show" id="productsStatus">
                            <label class="form-check-label" for="productsStatus">Change status</label>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="button" class="btn btn-outline-secondary me-auto"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#edit_active form").on("submit", function(e) {
        e.preventDefault();
        var form = $(this),
            formData = new FormData(this),
            action = form.attr("action"),
            method = form.attr("method"),
            controls = form.find("button, input"),
            spinner = $("#locationModal .loading-spinner");
        spinner.show();
        controls.prop("disabled", true);
        $.ajax({
                url: action,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
            })
            .done(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                if (response.status) {
                    toastr.success("product status change successfully");
                    $("#edit_active").modal("hide");
                    scope.$apply(() => {
                        if (scope.updateProduct === false) {
                            // scope.list.unshift(response.data);
                            scope.list = response.data;
                            scope.dataLoader();
                        } else {
                            scope.list[scope.updateProduct] = response.data;
                            scope.dataLoader();
                        }
                    });
                } else toastr.error(response.message);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                toastr.error(response.message);
                controls.log(jqXHR.responseJSON.message);
                $("#useForm").modal("hide");
            })
            .always(function() {
                spinner.hide();
                controls.prop("disabled", false);
            });
    });
</script>

{{-- delete product --}}
<div class="modal fade modal-sm" id="delete_product" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/products/delete">
                    @csrf @method('PUT')
                    <input hidden data-ng-value="list[updateProduct].product_id" name="id">
                    <p class="mb-2">Are you sure you want to delete the product ?</p>
                    <div class="d-flex mt-3">
                        <button type="button" class="btn btn-outline-secondary me-auto"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Sure</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#delete_product form").on("submit", function(e) {
        e.preventDefault();
        var form = $(this),
            formData = new FormData(this),
            action = form.attr("action"),
            method = form.attr("method"),
            controls = form.find("button, input"),
            spinner = $("#locationModal .loading-spinner");
        spinner.show();
        controls.prop("disabled", true);
        $.ajax({
                url: action,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
            })
            .done(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                if (response.status) {
                    toastr.success("product delete successfully");
                    $("#delete_product").modal("hide");
                    scope.$apply(() => {
                        if (scope.updateProduct === false) {
                            // scope.list.unshift(response.data);
                            scope.dataLoader(true);
                        } else {
                            scope.list[scope.updateProduct] = response.data;
                            scope.dataLoader(true);
                        }
                    });
                } else toastr.error(response.message);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                toastr.error(response.message);
                controls.log(jqXHR.responseJSON.message);
                $("#useForm").modal("hide");
            })
            .always(function() {
                spinner.hide();
                controls.prop("disabled", false);
            });
    });
</script>

{{-- <div class="modal fade modal-sm" id="delete_product" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="image-container">
                    <img src="image1.jpg" alt="Image 1">
                    <img src="image2.jpg" alt="Image 2">
                    <img src="image3.jpg" alt="Image 3">
                    <img src="image4.jpg" alt="Image 4">
                    <img src="image5.jpg" alt="Image 5">
                </div>
            </div>
        </div>
    </div>
</div> --}}
