@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('metode-bayar.update', $data->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="card card-sm rounded-3 mb-3 ">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label required">Metode Pembayaran</label>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Metode Pembayaran" required
                                        name="metode" value="{{ $data->metode }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <textarea rows="2" class="form-control" placeholder="Keterangan" required name="keterangan" value="">{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary rounded-3"><i class="bx bxs-save me-2"></i>Simpan
                                Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
