@if(!$penjualan)
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">Data tidak ditemukan.</div>
            </div>
        </div>
    </div>
@else
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="receipt-container">
                    <div class="receipt-header text-center mb-4">
                        <img src="{{ asset('adminlte/dist/img/aldomart.png') }}" alt="" class="store-logo mb-3">
                        <h3 class="mb-1">Aldo's-Mart</h3>
                        <p class="mb-0">Jl. P.Panaitan V No. 14</p>
                        <p class="mb-0">Telp: (021) 254930332</p>
                    </div>

                    <div class="receipt-body">
                        <!-- Ubah bagian informasi transaksi -->
                        <div class="transaction-info">
                            <div class="info-item">
                                <strong>Kode Transaksi:</strong> {{ $penjualan->penjualan_kode }}
                            </div>
                            <div class="info-item">
                                <strong>Tanggal:</strong> {{ $penjualan->penjualan_tanggal->translatedFormat('d M Y H:i') }}
                            </div>
                            <div class="info-item">
                                <strong>Kasir:</strong> {{ $penjualan->user->nama ?? 'System' }}
                            </div>
                            <div class="info-item">
                                <strong>Pembeli:</strong> {{ $penjualan->pembeli }}
                            </div>
                        </div>

                        <table class="table receipt-table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Barang</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan->details as $detail)
                                    <tr>
                                        <td>{{ $detail->barang->barang_nama ?? '-' }}</td>
                                        <td class="text-right">@currency($detail->harga)</td>
                                        <td class="text-center">{{ $detail->jumlah }}</td>
                                        <td class="text-right">@currency($detail->harga * $detail->jumlah)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th colspan="3" class="text-right">TOTAL</th>
                                    <th class="text-right">
                                        @currency($penjualan->details->sum(fn($d) => $d->harga * $d->jumlah))</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="receipt-footer text-center mt-4 d-print-block">
                        <p class="mb-1">Terima kasih telah membeli barang di toko Aldo's-Mart</p>
                        <p class="mb-0">Semoga Bermanfaat</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" onclick="printReceipt()">
                    <i class="fas fa-print"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
@endif

<style>
    .receipt-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 2px solid #000;
    }

    /* Styling baru untuk info transaksi */
    .transaction-info {
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .info-item {
        margin-bottom: 8px;
        font-size: 15px;
    }

    .info-item strong {
        display: inline-block;
        min-width: 120px;
        color: #2c3e50;
    },
    .store-logo {
        max-width: 120px;
        height: auto;
        display: block;
        margin: 0 auto 10px;
    }


    /* Tampilan cetak */
    @media print {
        .transaction-info {
            background: transparent !important;
            padding: 10px 0 !important;
        }

        .info-item {
            margin-bottom: 5px;
        }

        .info-item strong {
            min-width: 110px;
        }

        .receipt-container {
            border: none !important;
            padding: 0 !important;
        }
        .store-logo {
            max-width: 250px;
        }
        @page {
            size: auto;
            margin: 5mm;
        }
    }
</style>
<script>
    function printReceipt() {
        // Clone konten modal
        const originalContent = document.querySelector('.modal-content').cloneNode(true);

        // Hapus elemen yang tidak ingin dicetak
        originalContent.querySelector('.modal-header').remove();
        originalContent.querySelector('.modal-footer').remove();

        // Ambil semua stylesheet dari dokumen utama
        const stylesheets = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
            .map(el => el.outerHTML)
            .join('\n');

        const printWindow = window.open('', '_blank');

        printWindow.document.write(`
            <html>
                <head>
                    <title>Struk Penjualan</title>
                    ${stylesheets}
                    <style>
                        /* Reset style untuk cetakan */
                        body { 
                            margin: 0 !important; 
                            padding: 20px !important;
                            -webkit-print-color-adjust: exact;
                        }
                        
                        /* Sembunyikan elemen tidak perlu */
                        .modal-header, .modal-footer {
                            display: none !important;
                        }
                        
                        /* Sesuaikan dengan tampilan modal */
                        .receipt-container {
                            max-width: 500px;
                            margin: 0 auto;
                            border: 2px solid #000;
                            padding: 20px;
                        }
                        
                        @media print {
                            .receipt-container {
                                border: none;
                                padding: 0;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${originalContent.outerHTML}
                </body>
            </html>
        `);

        printWindow.document.close();

        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 500);
    }
</script>