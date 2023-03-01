{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Layanan')

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
                                <h2 class="text-white pb-2 fw-bold">Layanan </h2>
                                <h5 class="text-white op-7 mb-2">Kelola layanan yang disediakan disini.</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('admin.service.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah layanan</a>
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
                                                    <th width="8%">No</th>
													<th>Gambar</th>
                                                    <th>Layanan</th>
													<th>Deskripsi</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
                                                <tr>
                                                    <th>No</th>
													<th>Gambar</th>
                                                    <th>Layanan</th>
													<th>Deskripsi</th>
													<th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
												{{-- <tr>
													<td>1</td>
													<td><img class="img-product" src="{{ asset('assets/img/examples/product8.jpg') }}" alt=""></td>
													<td>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</td>
													<td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur amet voluptas excepturi veniam corporis deserunt quos nostrum non rem esse, dolore laudantium assumenda nisi cupiditate! Dolorem velit commodi fugiat quae.</td>
													<td>
														<a href="{{ route('edit-services') }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
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
	var title = 'Layanan';
	var columns = [0, 1, 3];
	$(document).ready( function () {
		var _token = "{{ csrf_token() }}";
		table =  $('#basic-datatables').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			
			ajax: {
				url : '{!! route('admin.service.data') !!}',
				type : 'POST',
				data: {_token:_token},
			},
			columns: [
				{ data: 'id',
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					} 
				  },
				{ 
					data: 'image_url',
					render: function(data, type, row){
						return '<img class="img-product" src="'+ data +'" alt="">';
					}
				},
				{ data: 'name_id' },
				{ data: 'text_description' },
				{
					data: 'id',
					render: function(data, type, row){
						var url_edit = "{{url('/admin/service/edit')}}"+"/"+data;
						return '\
						<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
						<button class="btn btn-xs btn-danger my-1" onclick="delete_data('+data+', \'service\')">Hapus</button>';
					}
				},
			]
		});
	} );
</script>
@include('admin.layouts.swal')
@endsection
