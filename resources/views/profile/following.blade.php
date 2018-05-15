@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				<div class="ttl-head padding-15px">
					<div class="ctn-main-font ctn-min-color ctn-16px">
						{{ $ttl_following }} Following
					</div>
				</div>
				<div class="place-follow">
					@if (count($profile) == 0)
						<div class="frame-empty">
							<div class="icn fa fa-lg fa-thermometer-empty btn-main-color"></div>
							<div class="ctn-main-font ctn-sek-color ctn-small padding-15px">Following Empty</div>
						</div>
					@else
						@foreach ($profile as $p)
							@include('main.frame-follow')
						@endforeach
					@endif
				</div>
			</div>
		</div>
		<div class="rig post-grid-2">
			@include('main.side-menu')
		</div>
	</div>
</div>
@endsection