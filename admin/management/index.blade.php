{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Susunan pengurus')

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
                                <h2 class="text-white pb-2 fw-bold">Manajemen Pt. BASE</h2>
                                <h5 class="text-white op-7 mb-2">Kelola manajemen</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('admin.management.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Manajemen</a>
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
										<table id="product-category-table" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>Nama</th>
                                                    <th>Position</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>Nama</th>
                                                    <th>Position</th>
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
		var title = 'Kategori Produk';
		var columns = [0, 2, 3];
		$(document).ready( function () {
			var _token = "{{ csrf_token() }}";
			table =  $('#product-category-table').DataTable({
				processing: true,
				serverSide: true,
                responsive: true,
				
				ajax: {
					url : '{!! route('admin.management.data') !!}',
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
						render: function (data, type, row) {
							return '<img class="img-product" src="'+data+'" alt="">';
						} 
					},
					{ data: 'name' },
					{ data: 'position_id' },
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{url('/admin/management/edit/')}}"+'/'+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" onclick="deleteManagement('+data+')">Delete</button>';
						}
					},
				]
			});
		} );

		function deleteManagement(id) {
			var _token = "{{ csrf_token() }}";
			var url = "{{url('/admin/management/')}}";
			Swal.fire({
				title: 'Anda yakin?',
				text: "Menghapus data manajemen ini!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!',
				cancelButtonText: 'Batal'
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: url+'/'+id,
						type:'DELETE',
						data: {_token:_token},
						success: function(data) {
							Swal.fire(
								'Terhapus!',
								'Manajemen sudah terhapus',
								'success'
							)
							table.ajax.reload();
						}
					});
				}
			})
		}

        var datanya = [];

        var _token = "{{ csrf_token() }}";
        $(document).ready(function () {
            $.ajax({
                url: 'http://127.0.0.1:8000/cobajson',
                type:'get',
                data: {_token:_token},
                dataType : 'JSON',
                success: function(data) {
                    data.forEach(function (e) {
                        // console.log(e);
                        // checked.push('cobababa');
                        console.log(Object.keys(e).map((key) => [Number(key), e[key]]));
                    })
                    // console.log(jQuery.parseJSON(data));
                }
            });
            // checked.push('cobababa');

            
            // console.log(datanya);
            // datanya.forEach(function (e) {
                //     console.log(e);
                // })
        })

        var checked = [];
        $(document).ready(function () {
            // if (jQuery.inArray($(this).val(), checked) !== -1) {
            //     // checked = jQuery.grep(checked, function(value) {
            //     //     return value != $(this).val();
            //     // });
            //     console.log('hapus');
            // }else{
                // checked.push('cobababa');
            // }
            console.log(checked);
        })
		

		
	</script>
@endsection
