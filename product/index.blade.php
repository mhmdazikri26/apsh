@extends('templates.owner.default')
@section('content')

@php
  $title = "Product";
  $preTitle = "Data";
@endphp

@push('page-action')
<span class="d-none d-sm-inline">
    
    <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open product menu">
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div class="d-none d-xl-block ps-2">
                <div>Paweł Kuna</div>
                <div class="mt-1 small text-muted">UI Designer</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            
            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
        </div>
    </div>
    <a href="{{ route('security.product.create') }}" class="btn btn-primary d-none d-sm-inline-block">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Data
</a>

@endpush

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Invoices</h3>
      </div>
      <div class="card-body border-bottom py-3">
        <div class="d-flex">
          <div class="text-muted">
            Show
            <div class="mx-2 d-inline-block">
              <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
            </div>
            entries
          </div>
          <div class="ms-auto text-muted">
            Search:
            <div class="ms-2 d-inline-block">
              <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              
              <th>Foto</th>
              <th>Nama</th>
              <th>kategori</th>
              <th>price</th>
           
              <th></th>
            </tr>
          </thead>
          <tbody>
@foreach ($product as $u)
    

<tr>
 
              <td><span class="text-muted">{{ $no++ }}</span></td>
              <td><img src="/images/{{ $u->image }}" height="120"alt=""></td>
              <td>
                {{ $u->name }}
              </td>
              <td>
                <span class="flag flag-country-idn"></span>
                {{ $u->category_list }}
              </td>
              <td>
                {{ $u->price}}
              </td>
           
              <td class="text-end">
                <span class="dropdown">
                  <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                  <div class="dropdown-menu dropdown-menu-end">
                    
                    <a class="dropdown-item" href="{{ route('security.product.edit', $u->id) }}">
                      Edit
                    </a>


                      <form action="{{ route('security.product.destroy', $u->id) }}" method="post">
                    @csrf
                    @method('DELETE') 
                    <input type="submit" value="Hapus"  class="dropdown-item" >
                      
                  

                   </form>
                  </div>
                </span>
              </td>
      
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
        <ul class="pagination m-0 ms-auto">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
              <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
              prev
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">5</a></li>
          <li class="page-item">
            <a class="page-link" href="#">
              next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection