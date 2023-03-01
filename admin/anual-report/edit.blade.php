{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Edit laporan tahunan')

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
                                    <div class="card-title">Edit laporan tahunan</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.report.update', ['AnnualReport' => $report->id]) }}" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="title_id">Judul laporan tahunan</label>
                                        <input type="text" class="form-control" id="title_id" name="title_id" placeholder="Judul laporan tahunan"  value="{{ old('title_id', $report->title_id) }}">
                                        @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="title_en">Report title (english)</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Judul laporan tahunan bahasa inggris"  value="{{ old('title_en', $report->title_en) }}">
                                        @error('title_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="year">Tahun</label>
                                        <input type="text" class="form-control" id="year" name="year" placeholder="Tahun"  value="{{ old('tahun', $report->year) }}">
                                        @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">File anual report</p>
                                        {{-- <img class="img-preview img-fluid mb-3"> --}}
                                        <?php 
                                            // $xplode = explode('.', $report->file) ;
                                            // $ext = end($xplode);
                                        ?>
                                        {{-- @if ($ext == 'pdf')
                                            <i class="fa fa-file-pdf my-2 mx-2" style="font-size: 60px; color: red;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>                                          
                                        @elseif ($ext == 'xls')
                                            <i class="fa fa-file-excel my-2 mx-2" style="font-size: 60px; color: green;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>
                                        @elseif ($ext == 'xlsx')
                                            <i class="fa fa-file-excel my-2 mx-2" style="font-size: 60px; color: green;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>
                                        @elseif ($ext == 'cvs')
                                            <i class="fa fa-file-excel my-2 mx-2" style="font-size: 60px; color: green;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>
                                        @elseif ($ext == 'doc')
                                            <i class="fa fa-file-word my-2 mx-2" style="font-size: 60px; color: blue;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>
                                        @elseif ($ext == 'docx')
                                            <i class="fa fa-file-word my-2 mx-2" style="font-size: 60px; color: blue;"></i>
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.report.donload', ['AnnualReport' => $report->id]) }}">Download</a>
                                            
                                        @endif --}}
                                        <i class="fa fa-file-pdf" style="font-size: 80px; color: red; display: none;"></i>
                                        <i class="fa fa-file-excel" style="font-size: 80px; color: green; display: none;"></i>
                                        <i class="fa fa-file-word" style="font-size: 80px; color: blue; display: none;"></i>
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="document" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 5 MB</p>
                                            <p class="mt--2">Hanya dapat mengunggah file berupa pdf atau ms.word</p>
                                        </div>
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button class="btn btn-primary btn-rounded">Edit laporan tahunan</button>
                                    <a href="{{ route('admin.report.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
        const pdf = document.querySelector('.fa-file-pdf');
        const xls = document.querySelector('.fa-file-excel');
        const doc = document.querySelector('.fa-file-word');
        // const imagePreview = document.querySelector('.img-preview');
        let filename = document.getElementById('file-name');
        // imagePreview.style.display='block';
        const allow = ['pdf','doc','docx','xls','csv','xlsx'];
        const ext = image.files[0].name.split(".").pop();
        const oFReader = new FileReader();
        filename.innerHTML = image.files[0].name;
        if (allow.includes(ext)) {
            if (ext == 'pdf') {
                pdf.style.display='block';
                doc.style.display='none';
                xls.style.display='none';
            }else if(ext == 'doc'){
                doc.style.display='block';
                pdf.style.display='none';
                xls.style.display='none';
            }else if(ext == 'docx'){
                doc.style.display='block';
                pdf.style.display='none';
                xls.style.display='none';
            }else if(ext == 'xls'){
                doc.style.display='none';
                pdf.style.display='none';
                xls.style.display='block';
            }else if(ext == 'csv'){
                doc.style.display='none';
                pdf.style.display='none';
                xls.style.display='block';
            }else if(ext == 'xlsx'){
                doc.style.display='none';
                pdf.style.display='none';
                xls.style.display='block';
            }
        }else{
            doc.style.display='none';
            pdf.style.display='none';
            xls.style.display='none';
        }
        // oFReader.readAsDataURL(image.files[0]);
        // console.log(filename.innerHTML);

        // oFReader.onload =function (oFREvent) {
        //     imagePreview.src = oFREvent.target.result;					
        // }
    }
    </script>
@endsection
