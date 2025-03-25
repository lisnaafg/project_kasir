<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Carbon\Carbon;

class Laporan extends Component
{
    public $tanggalMulai;
    public $tanggalSelesai;
    public $bulan;
    public $tahun;
    public $semuaTransaksi = [];

    public function mount()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->filterPerBulan();
    }

    public function filterPerBulan()
    {
        $this->semuaTransaksi = Transaksi::where('status', 'selesai')
            ->whereYear('created_at', $this->tahun)
            ->whereMonth('created_at', $this->bulan)
            ->get();
    }

    public function filterPerRentangTanggal()
    {
        if ($this->tanggalMulai && $this->tanggalSelesai) {
            $this->semuaTransaksi = Transaksi::where('status', 'selesai')
                ->whereBetween('created_at', [
                    Carbon::parse($this->tanggalMulai)->startOfDay(),
                    Carbon::parse($this->tanggalSelesai)->endOfDay(),
                ])->get();
        }
    }

    public function render()
    {
        return view('livewire.laporan', [
            'semuaTransaksi' => $this->semuaTransaksi
        ]);
    }

    public function cetakLaporan()
{
    $query = Transaksi::query();

    if ($this->bulan && $this->tahun) {
        $query->whereMonth('created_at', $this->bulan)
              ->whereYear('created_at', $this->tahun);
    }

    if ($this->tanggalMulai && $this->tanggalSelesai) {
        $query->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
    }

    $transaksi = $query->get();
    
    return view('cetak-laporan', compact('transaksi'));
}

}
