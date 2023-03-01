{{-- call header and footer --}}
@extends('admin.layouts.main')

@section('title',  'Video header')

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
                                <h2 class="text-white pb-2 fw-bold">Video Header</h2>
                                <h5 class="text-white op-7 mb-2">Video ini akan ditampilkan di bagian header halaman utama </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-7">
							<div class="card">
								<div class="card-body">
                                    @if ($video != null)
                                        <video controls style="width:100%">
                                            <source src="{{ asset($video->file != 'assets/video/video.mp4' ? 'storage/'.$video->file : $video->file ) }}" type="video/mp4">
                                        </video>
                                    @else
                                        {{-- <source src="{{ asset( 'storage/assets/video/video.mp4' ) }}" type="video/mp4"> --}}
                                        <div class="alert alert-warning">Belum Mengunggah Video</div>
                                    @endif
								</div>
							</div>
						</div>
                        <div class="col-md-5">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Ubah video header</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.video.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">File Video</p>
                                        {{-- <source class="img-preview img-fluid mb-3"> --}}
                                        <source src="{{ asset('assets/video/video.mp4') }}" class="img-preview img-fluid mb-3" type="video/mp4">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="video" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 10MB</p>
                                        </div>
                                        @error('video') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button class="btn btn-primary btn-rounded">Ganti video</button>
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
            $(document).ready(function() {
            $('#basic-datatables').DataTable({
				"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: 'Bflrtip',
                responsive: true,
                buttons: [
                    'print',
                    'excel',
                    'pdf',
                    'csv',
                    'copy'
                ],
				
			});
        })

		$('#delete1').click(function (e) {
			swal({
				title: 'Are you sure?',
				text: "You won't be able to delete this!",
				type: 'warning',
				buttons: {
					confirm: {
						text: 'Yes, delete it!',
						className: 'btn btn-danger'
					},
					cancel: {
						visible: true,
						className: 'btn btn-secondary'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					swal({
						title: 'Deleted!',
						text: 'Your file has been deleted.',
						type: 'success',
						buttons: {
							confirm: {
								className: 'btn btn-success'
							}
						}
					});
				} else {
					swal.close();
				}
			});
		});

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
    </script>
@endsection
