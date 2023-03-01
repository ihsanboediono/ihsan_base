{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Profil perusahaan')

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
                                    <div class="card-title">Form edit profil perusahaan</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="editor1">Deskripsi perusahaan</label>
                                        <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="Tuliskan deskripsi perusahaan">{{ old('description_id', $company->description_id ?? '') }}</textarea>
                                        @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="editor2">Deskripsi perusahaan (English)</label>
                                        <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="Write company description">{{ old('description_en', $company->description_en ?? '') }}</textarea>
                                        @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">Gambar</p>
                                        @if ($company != null  && $company->image != 'assets/img-custom/img-card-1.png')
                                            <img src="{{ asset('storage/'.$company->image ) }}" class="img-preview img-fluid mb-2">
                                        @else
                                            <img src="" class="img-preview img-fluid mb-2" style="display: none">
                                        @endif
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button class="btn btn-primary btn-rounded">Edit profil </button>
								</div>
                            </form>
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
