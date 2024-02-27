@extends('templates.owner.default')
@section('content')

<section class="content">
    <div class="container-fluid">
      <form action="{{route('security.product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputName">User Id</label>
                      <input type="text"  name="user_id"  class="form-control" id="exampleInputUser" placeholder="">
                      @error('nama')
                            <small>{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Nama Produk</label>
                      <input type="text"  name="name"  class="form-control" id="exampleInputName" placeholder="">
                      @error('nama')
                            <small>{{ $message }}</small>
                      @enderror
                    </div>
                    <label for="exampleInputName">Kategori Coffee</label>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="category_list" aria-label="Default select example">
                            <option value="1">Coffee</option>
                            <option value="2">Hot Coffee</option>
                            <option value="3">Cooll Coffee</option>
                        </select>
                        @error('category_list')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                  <div class="form-group">
                    <label for="exampleInputPrice">Harga</label>
                    <input type="Price" name="price" class="form-control" id="exampleInputPrice1" placeholder="">
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Foto Produk</label>
                    <input name="image" class="form-control" type="file" id="formFileMultiple" multiple>
                    @error('image')
                        <small>{{ $message }}</small>
                    @enderror
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
    </form>
          <!-- /.card -->
<!-- /.content -->

@endsection