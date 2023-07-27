<x-admin-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">User</h2>
                <button id="btn-open-form" type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#form-modal">+
                {{ __('text.create_new') }}</button>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>{{ __('text.full_name') }}</th>
                                            <th>{{ __('text.email') }}</th>
                                            <th>{{ __('text.role') }}</th>
                                            <th>{{ __('text.status') }}</th>
                                            <th>{{ __('text.created_at') }}</th>
                                            <th>{{ __('text.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $user->id }}</td>
                                                <td><a href="/users/{{ $user->id }}/products">{{ $user->first_name .' '. $user->last_name }}</a></td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                                <td>{{ $user->is_active ? __('text.active') : __('text.inactive') }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">{{ __('text.action') }}</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item" onclick="loadUserData()"><span class="fe fe-edit fe-12 mr-3"></span>{{ __('text.edit') }}</button>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#confirm-modal"><span class="fe fe-delete fe-12 mr-3"></span>{{ __('text.delete') }}</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">{{ __('text.first_name') }}</label>
                                    <input type="text" class="form-control" id="first_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">{{ __('text.last_name') }}</label>
                                    <input type="text" class="form-control" id="last_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="email">{{ __('text.email') }}</label>
                                    <input type="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username">Username</label>
                                    <input class="form-control input-phoneus" id="username" maxlength="14" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="password">{{ __('text.password') }}</label>
                                    <input type="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="role">{{ __('text.role') }}</label>
                                    <select class="form-control select2" id="role" required>
                                        <option value="" selected></option>
                                        <option value="User">User</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-3 mx-auto mb-3">
                                    <p class="mb-3">{{ __('text.status') }}</p>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" required>
                                        <label class="custom-control-label" for="status">{{ __('text.active') }}</label>
                                    </div>
                                </div>
                            </div>
                            <button id="btn-save" class="col-md-1 btn btn-primary" type="button">{{ __('text.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="confirm-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">{{ __('text.confirm_delete_user') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button id="btn-delete" type="button" class="btn mb-2 btn-danger" data-dismiss="modal">{{ __('text.yes') }}</button>
                    <button type="button" class="btn mb-2 btn-light" data-dismiss="modal">{{ __('text.no') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/form.js') }}"></script>
    <script src="{{ URL::asset('js/table.js') }}"></script>
    <script src="{{ URL::asset('js/users.js') }}"></script>
</x-admin-layout>
