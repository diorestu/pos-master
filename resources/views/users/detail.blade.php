@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-3 mb-3">
                    <div class="card card-sm rounded-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar rounded-circle">
                                        <i class="bx bxs-bell bx-sm"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div>
                                        <h2 class="fw-bold mb-0">103 SDM</h2>
                                    </div>
                                    <div class="text-muted">
                                        32 shipped
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-sm rounded-3">
                        <div class="card-header overflow-hidden rounded-3">
                            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                @for ($i = 1; $i <= 31; $i++)
                                    <li class="nav-item">
                                        <a href="#tabs-home-ex{{ $i }}" class="nav-link" data-bs-toggle="tab">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <div class="card-body">
                            @for ($i = 1; $i <= 31; $i++)
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabs-home-ex{{ $i }}">
                                        {{ $i }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
