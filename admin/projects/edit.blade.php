{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Edit proyek')

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
                                    <div class="card-title">Form edit proyek</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.project.update' , ['project' => $project->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        {{-- <div class="form-group" style="position: relative">
                                            <label for="coordinate">Koordinat</label>
                                            <div class="hint">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae, illo? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, dolorum. Iste obcaecati sapiente, qui maiores rerum facere totam consectetur non quae ut, libero hic architecto nemo molestias delectus, reiciendis sint. Quisquam, atque quaerat. Laboriosam, suscipit mollitia nesciunt distinctio minima hic.<a href="https://www.google.co.id/maps" target="_blank">Disini.</a> </p>
                                            </div>
                                            <input type="text" class="form-control" id="coordinate" name="coordinate" placeholder="Koordinat" value="{{ old('coordinate', $project->coordinate) }}">
                                            @error('coordinate') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Status</label>
                                            <select class="form-control" id="tipe" name="type">
                                                <option disabled selected>- Select type -</option>
                                                <option value="refactory" @selected(old('type', $project->type) == "refactory")>Refactory</option>
                                                <option value="mechanical" @selected(old('type', $project->type) == "mechanical")>Mechanical</option>
                                                <option value="electrical" @selected(old('type', $project->type) == "electrical")>Electrical</option>
                                            </select>
                                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="name_id">Nama proyek</label>
                                            <input type="text" class="form-control" id="name_id" name="name_id" placeholder="Nama proyek" value="{{ old('name_id', $project->name_id) }}">
                                            @error('name_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="name_en">Nama proyek (English)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nama proyek bahasa inggris" value="{{ old('name_en', $project->name_en) }}">
                                            @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="description_id">Deskripsi Proyek</label>
                                            <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id', $project->description_id) }}</textarea>
                                            @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="description_en">Deskripsi Proyek (English)</label>
                                            <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en', $project->description_en) }}
                                            </textarea>
                                            @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option disabled selected>- Select status -</option>
                                                <option value="onprogress" @selected(old('status', $project->status) == "onprogress")>Dalam proses</option>
                                                <option value="finished" @selected(old('status', $project->status) == "finished")>Selesai</option>
                                            </select>
                                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date">Tanggal mulai</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="" value="{{ old('start_date', $project->start_date) }}">
                                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date">Tanggal berakhir</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="" aria-describedby="emailHelp" {{ old('status', $project->status) == "onprogress" ? 'disabled' : '' }} value="{{ old('end_date', $project->end_date) }}">
                                                    <small id="emailHelp" class="form-text text-muted text-info">Tidak usah diisi jika proyek masih dalam proses pengerjaan</small>
                                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <p style="font-weight: 600">Gambar</p>
                                            <img class="img-preview img-fluid mb-3" src="{{ $project->image_url }}">
                                            <p id="file-name"></p>
                                            <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                            <div class="info">
                                                <p>Max size : 1MB</p>
                                            </div>
                                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <button class="btn btn-primary btn-rounded" type="submit">Edit Project</button>
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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

    <script>
        const status = document.querySelector('#image');

        $('#status').on('click', function () {
            var optionvalue = $('#status option:selected').val();

            if (optionvalue == 'onprogress') {
                $("#end_date").prop("disabled", true);
            } else {
                $("#end_date").prop("disabled", false);
            }
        });



        $(document).mouseup(function(e){
            var container = $(".with-hint");
            if(!container.is(e.target) && container.has(e.target).length === 0){
                $('.hint').css('display','none')
            }else{
                $('.hint').css('display','block')
            }
        });
    </script>
@endsection
