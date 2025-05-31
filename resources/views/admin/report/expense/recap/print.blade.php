@php
  use App\Models\Setting;
@endphp

@extends('admin._layouts.print-report', [
    'title' => 'Laporan Rekapitulasi Pengeluaran Bulanan',
])

@section('content')
  <h5 class="text-center">LAPORAN REKAPITULASI PENGELUARAN</h5>
  <h5 class="text-center">{{ Str::upper(Setting::value('company.name')) }}</h5>
  <h6 class="text-center">Periode: {{ $period[0] . ' - ' . $period[1] }}</h6>
  <table class="report-table">
    <thead style="background:#08e;color:#fff;">
      <th>No</th>
      <th>Kategori</th>
      <th>Jumlah</th>
    </thead>
    <tbody>
      @php $total = 0 @endphp
      @forelse ($items as $num => $item)
        <tr style="vertical-align:top;">
          <td class="text-right">{{ $num + 1 }}</td>
          <td class="text-left">{{ $item->name }}</td>
          <td class="text-right">{{ format_number($item->total) }}</td>
        </tr>
        @php $total += $item->total @endphp
      @empty
        <tr>
          <td colspan="3" class="text-center font-italic text-muted">Tidak ada rekaman</td>
        </tr>
      @endforelse
    </tbody>
    <tfoot style="background:#08e;color:#fff;">
      <th colspan="2">Total</th>
      <th class="text-right">{{ format_number($total) }}</th>
    </tfoot>
  </table>
@endSection
