<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\DetilTransaksi;
use App\Models\Produk; // ✅ Tambahkan ini
use Illuminate\Support\Facades\DB;


class Transaksi extends Component
{
    public function render()
{
    // Pastikan transaksi aktif ada
    $semuaProduk = [];
    if ($this->transaksiAktif) {
        $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
        $this->totalSebelumBelanja = $semuaProduk->sum(function ($detil) {
            return $detil->jumlah * $detil->produk->harga;
        });
    }

    return view('livewire.transaksi', [
        'semuaProduk' => $semuaProduk,
        'totalSemuaBelanja' => $this->totalSebelumBelanja ?? 0
    ]);
}


    public $kode, $total, $bayar = 0, $kembalian, $totalSebelumBelanja;
    public $transaksiAktif = null; // Ubah dari private ke public

    public function transaksiBaru(): void
    {
        $this->reset(['kode', 'total', 'bayar', 'kembalian', 'totalSebelumBelanja']);
        $this->transaksiAktif = ModelsTransaksi::create([
            'kode' => 'INV' . date('YmdHis'),
            'total' => 0,
            'status' => 'pending'
        ]);
    }

    public function batalTransaksi(): void
    {
        if ($this->transaksiAktif) {
            $detilTransaksi = DetilTransaksi::where( 'transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil) {
                $produk =Produk::find($detil->produk_id);
                $produk->stok += $detil->jumlah;
                $produk->save();
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }

        $this->reset();
    }

    public function updatedKode(): void
    {
        $produk = Produk::where( 'kode',  $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detil = DetilTransaksi::firstOrNew(attributes: [
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id' => $produk->id
            ], values: [
                'jumlah' => 0
            ]);
            $detil->jumlah += 1;
            $detil->save();
            $produk->stok -= 1;
            $produk->save();
            $this->reset('kode');

            
        }
    }

    public function hapusProduk($id)
    {
        $detil = DetilTransaksi::find($id);
        if($detil){
            $produk = Produk::find($detil->produk_id);
            $produk->stok += ($detil->jumlah);
            $produk->save();
        }
        $detil->delete();
    }

    public function transaksiSelesai()
    {
        if (!$this->transaksiAktif) {
            session()->flash('error', 'Tidak ada transaksi yang sedang berlangsung!');
            return;
        }

        // Hitung total transaksi
        $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

        if ($this->bayar < $this->totalSebelumBelanja) {
            session()->flash('error', 'Pembayaran tidak cukup!');
            return;
        }

        // Update transaksi menjadi selesai
        $this->transaksiAktif->total = $this->totalSebelumBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();
        

        session()->flash('success', 'Transaksi berhasil diselesaikan!');

        // Cetak nota otomatis setelah transaksi selesai
        return redirect()->route('nota.cetak', ['id' => $this->transaksiAktif->id]);
    }

    public function updatedBayar()
    {
        $this->bayar = (float) $this->bayar;

        // Hitung ulang total setiap kali pembayaran diubah
        $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

        $this->kembalian = max($this->bayar - $this->totalSebelumBelanja, 0); // Tidak boleh negatif
    }

    public function tambahJumlah($produkId)
    {
        $produk = DetilTransaksi::find($produkId);
        if ($produk) {
            $produk->jumlah += 1;
            $produk->save();
            $this->hitungTotal();
        }
    }

    public function kurangiJumlah($produkId)
    {
        $produk = DetilTransaksi::find($produkId);
        if ($produk && $produk->jumlah > 1) {
            $produk->jumlah -= 1;
            $produk->save();
            $this->hitungTotal();
        }
    }

    private function hitungTotal()
    {
        $this->totalSebelumBelanja = DetilTransaksi::join('produks', 'detil_transaksis.produk_id', '=', 'produks.id')
            ->where('detil_transaksis.transaksi_id', $this->transaksiAktif->id)
            ->sum(DB::raw('detil_transaksis.jumlah * produks.harga'));
    }

    public function printNota()
{
    // Pastikan hanya transaksi selesai yang bisa dicetak
    if (!$this->transaksiAktif || $this->transaksiAktif->status !== 'selesai') {
        session()->flash('error', 'Nota hanya bisa dicetak setelah transaksi selesai!');
        return;
    }

    return redirect()->route('nota.cetak', ['id' => $this->transaksiAktif->id]);
}


    
}    