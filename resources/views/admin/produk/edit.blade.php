@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row mb-5">
                <div class="col-2">
                    <div class="card">
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col-10">
                    <form action="" method="post">
                        <div class="card card-sm rounded-3 mb-3 ">
                            <div class="card-header overflow-hidden rounded-3">
                                <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tabs-home-ex1" class="nav-link active" data-bs-toggle="tab">
                                            Data Diri
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-home-ex2" class="nav-link" data-bs-toggle="tab">
                                            Data Administrasi
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="tabs-home-ex1">
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <label class="col-4 col-form-label required">NIK</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="NIK" required
                                                        name="nik" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-home-ex2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded-3 w-100">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
