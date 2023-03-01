{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah karir')

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
                                    <div class="card-title">Form tambah lowongan pekerjaan</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.career.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title_id">Nama lowongan pekerjaan</label>
                                        <input type="text" class="form-control" id="title_id" name="title_id" placeholder="Nama lowongan pekerjaan" value="{{ old('title_id') }}">
                                        @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="title_en">Nama lowongan pekerjaan (English)</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Nama lowongan pekerjaan bahasa inggris" value="{{ old('title_en') }}">
                                        @error('title_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="form-group col-md">
                                            <label for="start_date">Mulai</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md">
                                            <label for="end_date">Selesai</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_id">Deskripsi lowongan pekerjaan</label>
                                        <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id') }}</textarea>
                                        @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="description_en">Deskripsi lowongan pekerjaan (English)</label>
                                        <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en') }}</textarea>
                                        @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    {{-- <div class="form-group col-md-4">
                                        <p style="font-weight: 600">Gambar</p>
                                        <img class="img-preview img-fluid mb-3">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <button class="btn btn-primary btn-rounded">Tambah lowongan pekerjaan </button>
                                    <a href="{{ route('admin.career.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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

        var editor = CKEDITOR.replace("editor1", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor);
            var editor2 = CKEDITOR.replace("editor2", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor2);
    </script>
@endsection
