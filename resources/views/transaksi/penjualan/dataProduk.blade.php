<div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td class="text-end">Rp {{ number_format($item->harga_produk) }}</td>
                                <td class="text-center">
                                    <form data-action="{{ route('item-penjualan.store') }}" method="post"
                                        class="pilih-produk" id="pilihProduk">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="id_penjualan" value="{{ $pesanan->id }}">
                                        <input type="hidden" name="id_produk" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Pilih Item</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
