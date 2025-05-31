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
        <div class="col-lg-3 col-6">
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
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $data['active_sales_count'] }}</h4>
              <p>Order Penjualan Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-invoice"></i>
            </div>
            <a href="/admin/sales-order?status=0" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number($data['total_sales_today']) }}</h4>
              <p>Omset Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-money-bills"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ $data['sales_count_today'] }}</h4>
              <p>Order Hari Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-receipt"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      @if (Auth::user()->canAccess(AclResource::EXECUTIVE_DASHBOARD))
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>Rp. {{ format_number($data['total_inventory_asset']) }}</h4>
              <p>Total Modal Inventori</p>
            </div>
            <div class="icon">
              <i class="fas fa-boxes"></i>
            </div>
            <a href="/admin/product" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>Rp. {{ format_number($data['total_inventory_asset_price']) }}</h4>
              <p>Total Nilai Jual Inventori</p>
            </div>
            <div class="icon">
              <i class="fa fa-boxes"></i>
            </div>
            <a href="/admin/product" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number($data['total_sales_this_month']) }}</h4>
                <p>Omset Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-money-bills"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h4>{{ $data['sales_count_this_month'] }}</h4>
                <p>Penjualan Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="fa fa-receipt"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>Rp. {{ format_number($data['gross_sales_this_month']) }}</h4>
              <p>Laba Kotor Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
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
        </div>
      </div>
      @endif
    </div>
  </section>
@endsection
