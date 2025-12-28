<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tglAwal = $request->tgl_awal ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $tglAkhir = $request->tgl_akhir ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        $query = Pengaduan::with('mahasiswa')->latest();
        $query->whereDate('created_at', '>=', $tglAwal)
              ->whereDate('created_at', '<=', $tglAkhir);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->paginate(10)->withQueryString();

        return view('laporan.index', compact('pengaduans', 'tglAwal', 'tglAkhir'));
    }

    public function cetak(Request $request)
    {
        $tglAwal = $request->tgl_awal ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $tglAkhir = $request->tgl_akhir ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        $status = $request->status;

        $pengaduans = Pengaduan::with('mahasiswa')
            ->whereDate('created_at', '>=', $tglAwal)
            ->whereDate('created_at', '<=', $tglAkhir)
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })->latest()->get();
        $pdf = Pdf::loadView('laporan.cetak', compact('pengaduans', 'tglAwal', 'tglAkhir', 'status'));
        $pdf->setPaper('a4', 'landscape');
        $namaFile = 'Laporan_' . Carbon::now()->format('dmY_His') . '.pdf';
        return $pdf->download($namaFile);
    }
}