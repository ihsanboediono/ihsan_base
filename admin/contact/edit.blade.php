{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Kontak')

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
                                    <div class="card-title">Form edit Contact</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.contact.update') }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <div class="form-group">
                                            <label for="whatsapp">No whatsapp </label>
                                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp contoh +62823456789" value="{{ old('whatsapp', $contact->whatsapp) }}">
                                            @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram </label>
                                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram" value="{{ old('instagram', $contact->instagram) }}">
                                            @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="linkedin">Linkedin </label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="linkedin" value="{{ old('linkedin', $contact->linkedin) }}">
                                            @error('linkedin') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook">Facebook </label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="facebook" value="{{ old('facebook', $contact->facebook) }}">
                                            @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email', $contact->email) }}">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">phone </label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="{{ old('phone', $contact->telephone) }}">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <textarea class="form-control" rows="5" name="address" placeholder="tulisakan alamat lengkap">{{ old('address',$contact->address) }}</textarea>
                                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <button class="btn btn-primary btn-rounded" type="submit">Edit contact </button>
                                        <a href="{{ route('admin.contact.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
@endsection
