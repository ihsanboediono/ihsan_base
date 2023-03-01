{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Laporan tahunan')

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
                                <h2 class="text-white pb-2 fw-bold">Laporan tahunan </h2>
                                <h5 class="text-white op-7 mb-2">Kelola laporan tahunan PT. BASE disini</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('admin.report.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tahun</th>
                                                    <th>Judul</th>
													<th>File</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tahun</th>
                                                    <th>Judul</th>
													<th>File</th>
													<th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
												{{-- <tr>
													<td>1</td>
													<td>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</td>
													<td><img class="img-product" src="{{ asset('assets/img/examples/product8.jpg') }}" alt=""></td>
													<td>
                                                        <a href="{{ route('admin.edit-report') }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
														<button type="button" id="delete1" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash mr-1"></i> Hapus</button>
													</td>
												</tr> --}}
											</tbody>
										</table>
									</div>
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
	var table;
	var title = 'Laporan Tahunan';
	var columns = [0, 1, 2];
	$(document).ready( function () {
		var _token = "{{ csrf_token() }}";
		table =  $('#basic-datatables').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			
			ajax: {
				url : '{!! route('admin.report.data') !!}',
				type : 'POST',
				data: {_token:_token},
			},
			columns: [
				{ data: 'id',
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					} 
				  },
				{ data: 'year' },
				{ data: 'title_id' },
				{ 
					data: 'file',
					render: function(data, type, row){
						const allow = ['pdf','doc','docx','xls','csv','xlsx'];
        				const ext = row.file.split(".").pop();
						if (allow.includes(ext)) {
							if (ext == 'pdf') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-pdf my-2 mx-2" style="font-size: 20px; color: white;"></i>Download</a>';
							}else if (ext == 'xls') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-excel my-2 mx-2" style="font-size: 20px; color: green;"></i>Download</a>';
							}else if (ext == 'csv') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-excel my-2 mx-2" style="font-size: 20px; color: green;"></i>Download</a>';
							}else if (ext == 'xlsx') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-excel my-2 mx-2" style="font-size: 20px; color: green;"></i>Download</a>';
							}else if (ext == 'doc') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-word my-2 mx-2" style="font-size: 19px; color: blue;"></i>Download</a>';
							}else if (ext == 'docx') {
								return '<a class="btn btn-sm btn-info" style="padding:2px 13px" href="{{ url('admin/report/download/') }}/'+row.id+'"><i class="fa fa-file-word my-2 mx-2" style="font-size: 19px; color: blue;"></i>Download</a>';
							}
						}
					}
				},
				{
					data: 'id',
					render: function(data, type, row){
						var url_edit = "{{url('/admin/report/edit')}}"+"/"+data;
						return '\
						<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
						<button class="btn btn-xs btn-danger my-1" onclick="delete_data('+data+', \'report\')">Hapus</button>';
					}
				},
			]
		});
	} );
</script>
@include('admin.layouts.swal')
@endsection
