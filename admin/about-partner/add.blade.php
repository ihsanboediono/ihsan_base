{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah mitra')

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
                                    <div class="card-title">Form tambah mitra</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama mitra</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama mitra" value="{{ old('nama') }}">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="web">Link web</label>
                                        <input type="text" class="form-control" id="web" name="web" placeholder="Link web" value="{{ old('web') }}">
                                        @error('web') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">Logo mitra</p>
                                        <img class="img-preview img-fluid mb-2" style="display: none">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="logo" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button class="btn btn-primary btn-rounded">Tambah Mitra</button>
                                    <a href="{{ route('admin.partner.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
