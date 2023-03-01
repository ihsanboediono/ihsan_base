{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah susunan pengurus')

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
                                    <div class="card-title">Form Tambah Manajemen</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.management.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ old('name') }}">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="position_id">Jabatan</label>
                                            <input type="text" class="form-control" id="position_id" name="position_id" placeholder="Jabatan" value="{{ old('position_id') }}">
                                            @error('position_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="position_en">Jabatan (English)</label>
                                            <input type="text" class="form-control" id="position_en" name="position_en" placeholder="Jabatan bahasa inggris" value="{{ old('position_en') }}">
                                            @error('position_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group col-md-4">
                                            <p style="font-weight: 600">Gambar</p>
                                            <img class="img-preview img-fluid mb-3">
                                            <p id="file-name" style="display: none;"></p>
                                            <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                            <div class="info">
                                                <p>Max size : 1MB</p>
                                            </div>
                                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <button class="btn btn-primary btn-rounded" type="submit">Tambah manajemen</button>
                                        <a href="{{ route('admin.management.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
				filename.style.display='block';

				const oFReader = new FileReader();
				oFReader.readAsDataURL(image.files[0]);
				filename.innerHTML = image.files[0].name;

				oFReader.onload =function (oFREvent) {
					imagePreview.src = oFREvent.target.result;					
				}
			}

            // stock format
            $('input[name="_stock_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "");
                });
            });
            // price format
            $('input[name="_price_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                // format number
                $(this).val(function(index, value) {
                    return "Rp. " + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                });
            });
    </script>
@endsection
