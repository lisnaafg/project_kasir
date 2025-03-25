<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetilTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function cetakNota($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $detilTransaksi = DetilTransaksi::where('transaksi_id', $id)->get();

        $pdf = Pdf::loadView('nota', compact('transaksi', 'detilTransaksi'));
        return $pdf->stream('Nota_Transaksi_'.$transaksi->kode.'.pdf');
    }
}
