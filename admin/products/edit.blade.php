{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Edit produk')

@section('content')

<body>
    <div class="wrapper">
        {{-- call header --}}
        @include('admin.layouts.header')
        {{-- call sidebar --}}
        @include('admin.layouts.sidebar')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold"></h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-8">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form edit produk</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.product.update', ['product'=> $product->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name_id">Nama produk</label>
                                            <input type="text" class="form-control" id="name_id" name="name_id" placeholder="Nama produk" value="{{ old('name_id', $product->name_id) }}">
                                            @error('name_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="name_en">Nama produk (English)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nama produk" value="{{ old('name_en', $product->name_en) }}">
                                            @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="category">Kategori produk</label>
                                            <select class="form-control" id="category" name="category">
                                                <option disabled selected>- Pilih kategori -</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>{{ $category->title_id }}</option>
                                                @endforeach
                                            </select>
                                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ old('link', $product->link) }}">
                                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description_id">Deskripsi produk</label>
                                            <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id', $product->description_id) }}</textarea>
                                            @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="description_en">Deskripsi produk (English)</label>
                                            <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en', $product->description_en) }}</textarea>
                                            @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group col-md-4">
                                            <p style="font-weight: 600">Gambar</p>
                                            <img class="img-preview img-fluid mb-3" src="{{ $product->image_url }}">
                                            <p id="file-name"></p>
                                            <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                            <div class="info">
                                                <p>Max size : 1MB</p>
                                            </div>
                                        </div>
                                        
                                        <button class="btn btn-primary btn-rounded">Edit produk </button>
                                        <a href="{{ route('admin.product.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                    </form>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.tupaitech.net">Tupai Tech</a>
					</div>				
				</div>
			</footer>
        </div>
    </div>
</body>

@endsection

@section('js')
    <script>
            // thumbnail
            function previewImage() {
				const image = document.querySelector('#image');
				const imagePreview = document.querySelector('.img-preview');
				let filename = document.getElementById('file-name');
				imagePreview.style.display='block';

				const oFReader = new FileReader();
				oFReader.readAsDataURL(image.files[0]);
				filename.innerHTML = image.files[0].name;

				oFReader.onload =function (oFREvent) {
					imagePreview.src = oFREvent.target.result;					
				}
			}

    </script>
@endsection
