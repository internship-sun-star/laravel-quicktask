<x-admin-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">{{ __('text.product') }}</h2>
                <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#form-modal">+
                {{ __('text.create_new') }}</button>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>{{ __('text.product_name') }}</th>
                                            <th>{{ __('text.price') }}</th>
                                            <th>{{ __('text.inventory') }}</th>
                                            <th>{{ __('text.created_at') }}</th>
                                            <th>{{ __('text.updated_at') }}</th>
                                            <th>{{ __('text.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->inventory }}</td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">{{ __('text.action') }}</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#form-modal"><span class="fe fe-edit fe-12 mr-3"></span>{{ __('text.edit') }}</button>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#confirm-modal"><span class="fe fe-delete fe-12 mr-3"></span>{{ __('text.delete') }}</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div id="form-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card shadow">
                    <div class="card-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="form-group mb3">
                                <div class="col-md-12 mb-3">
                                    <label for="name">{{ __('text.product_name') }}</label>
                                    <input type="text" class="form-control" id="name" required>
                                    <div class="valid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group mb3">
                                <div class="col-md-12 mb-3">
                                    <label for="price">{{ __('text.price') }}</label>
                                    <input type="number" class="form-control" id="price" value="0.00" required>
                                    <div class="valid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group mb3">
                                <div class="col-md-12 mb-3">
                                    <label for="inventory">{{ __('text.inventory') }}</label>
                                    <input type="number" class="form-control" id="inventory" value="0" required>
                                    <div class="valid-feedback"></div>
                                </div>
                            </div>
                            <button class="col-md-1 btn btn-primary" type="submit">{{ __('text.save') }}</button>
                        </form>
                    </div> <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <div id="confirm-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">{{ __('text.confirm_delete_product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-danger" data-dismiss="modal">{{ __('text.yes') }}</button>
                    <button type="button" class="btn mb-2 btn-light" data-dismiss="modal">{{ __('text.no') }}</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
