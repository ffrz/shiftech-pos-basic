@php
  use App\Models\AclResource;
@endphp


@extends('admin._layouts.default', [
    'title' => 'Dashboard',
    'nav_active' => 'dashboard',
])

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        {{-- <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $data['active_service_order_count'] }}</h4>
              <p>Order Servis Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-screwdriver-wrench"></i>
            </div>
            <a href="/admin/service-order?order_status=0&service_status=-1&payment_status=-1" class="small-box-footer"><i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        <div class="col-lg-4 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number($data['total_sales_today']) }}</h4>
              <p>Omset Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-money-bills"></i>
            </div>
            <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $data['sales_count_today'] }}</h4>
              <p>Jumlah Order Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-receipt"></i>
            </div>
            <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $data['active_sales_count'] }}</h4>
              <p>Order Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-invoice"></i>
            </div>
            <a class="small-box-footer" href="/admin/sales-order?status=0"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      @if (Auth::user()->canAccess(AclResource::EXECUTIVE_DASHBOARD))
        <div class="row">
          <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number($data['total_sales_this_month']) }}</h4>
                <p>Total Omset Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bills"></i>
              </div>
              <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>{{ $data['sales_count_this_month'] }}</h4>
                <p>Jumlah Penjualan Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-receipt"></i>
              </div>
              <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Rp. {{ format_number($data['gross_sales_this_month']) }}</h4>
                <p>Laba Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Rp. {{ format_number($data['total_inventory_asset']) }}</h4>
                <p>Total Modal Inventori</p>
              </div>
              <div class="icon">
                <i class="fas fa-boxes"></i>
              </div>
              <a class="small-box-footer" href="/admin/product"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Rp. {{ format_number($data['total_inventory_asset_price']) }}</h4>
                <p>Total Aset Inventori</p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
              <a class="small-box-footer" href="/admin/product"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          {{-- <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>Rp. {{ format_number($data['expenses_this_month']) }}</h4>
              <p>Pengeluaran Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="/admin/expense" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        </div>
      @endif
    </div>
  </section>
@endsection
