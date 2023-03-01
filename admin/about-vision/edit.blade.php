{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Visi')

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
                                    <div class="card-title">Form edit visi</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.vision.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="description_id">Visi perusahaan</label>
                                            <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id', $vision->description_id) }}</textarea>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="description_en">Visi perusahaan (English)</label>
                                            <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en', $vision->description_en) }}
                                            </textarea>
                                        </div> --}}
                                        
                                        <button class="btn btn-primary btn-rounded">Edit Visi </button>
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
