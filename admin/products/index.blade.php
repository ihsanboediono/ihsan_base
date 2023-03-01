{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Produk')

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
                                <h2 class="text-white pb-2 fw-bold">Produk PT BASE</h2>
                                <h5 class="text-white op-7 mb-2">Kelola semua produk yang dipunyai PT BASE</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('admin.product.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Produk</a>
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
										<table id="product-table" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
													<th>Gambar</th>
													<th>Deskripsi</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
													<th>Gambar</th>
													<th>Deskripsi</th>
													<th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
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
		var title = 'Produk';
		var columns = [0, 1, 3];
		$(document).ready( function () {
			var _token = "{{ csrf_token() }}";
			table =  $('#product-table').DataTable({
				processing: true,
				serverSide: true,
                responsive: true,
				
				ajax: {
					url : '{!! route('admin.product.data') !!}',
					type : 'POST',
					data: {_token:_token},
				},
				columns: [
					{ data: 'id',
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						} 
					  },
					{ data: 'name_id' },
					{ 
						data: 'image_url',
						render : function(data, type, row) {
							return '<img class="img-product" src="'+data+'" alt="">';
						}
					},
					{ data: 'description_id_plain_short' },
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{url('/admin/product/edit')}}"+"/"+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" onclick="delete_data('+data+', \'product\')">Delete</button>';
						}
					},
				]
			});
		} );

	</script>
@include('admin.layouts.swal')
@endsection
