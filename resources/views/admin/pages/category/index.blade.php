@extends('layouts.admin.app')

@section('title','Categories List')

@section('content')
    <section class="datatables">
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                category name
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#collapse-subcategory-id">toggle</button>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                        <div id="collapse-subcategory-id" class="collapse mt-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-fill">
                                            category name
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#collapse-sub-subcategory-id">toggle</button>
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </div>
                                    <div id="collapse-sub-subcategory-id" class="collapse mt-3">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        category name
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-primary">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-fill">
                                                        category name
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-primary">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-fill">
                                            category name
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-fill">
                                            category name
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                category name
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                category name
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                category name
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection

