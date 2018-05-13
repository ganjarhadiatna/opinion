<?php use App\ProfileModel; ?>
@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				@foreach (ProfileModel::UserSmallData(Auth::id()) as $dt)
					<a href="{{ url('/compose') }}">
						<div class="frame-post">
							<div class="mid">
								<div class="pos top-tool">
									<div class="grid grid-3x">
										<div class="grid-1">
											<div class="image image-35px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
										</div>
										<div class="grid-2">
											<div class="main-ttl">
												Create Your Opinion
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				@endforeach
				@if (count($topStory) == 0)
					@include('main.post-empty')
				@else
					<div>
						@foreach ($topStory as $story)
							@include('main.post')
						@endforeach
					</div>
					{{ $topStory->links() }}
				@endif
			</div>
		</div>
		<div class="rig post-grid-2">
			@include('main.side-menu')
		</div>
	</div>
</div>
@endsection