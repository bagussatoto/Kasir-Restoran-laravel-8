@extends('admin.main2')
@section('title','Edit Discount')
@section('content')

@if(session('result') == 'fail')
<div class="alert alert-danger data-dismissible" role="alert">
  <h4 class="alert-heading">Ups!</h4>Ada Kesalahan Saat Menginputkan Data, Silahkan Check Kembali.
  <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<div class="row">
	<div class="col-md-6 mx-auto">
		<form action="{{route('getEdit',['id' =>$discount->id])}}" method="POST">
			@csrf
			<div class="card">
				<div class="card header bg-primary pb-1">
					<h5 class="text-light pl-2 pt-2"><span class="oi oi-pencil"></span> Edit Discount</h5>
				</div>
				<div class="card-body">
					<div class="form-group form-label-group">
						<label for="iPercentOff">Percent Off</label>
						<input type="number" min="1" max="100" name="percent_off" class="form-control {{$errors->has('percent_off')?'is-invalid':''}}"
						value="{{old('percent_off',$discount->percent_off)}}" required autofocus>
						@if($errors->has('percent_off'))
						<div class="invalid-feedback">
							{{$errors->first('percent_off')}}
						</div>
						@endif
					</div>
				
				<div class="card-footer">
					<button class="btn btn-primary" type="submit">Update</button>
				</div>

				</div>
			</div>
		</form>
	</div>
</div>

@endsection