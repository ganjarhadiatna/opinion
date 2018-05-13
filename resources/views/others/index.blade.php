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
						{{ $title }}
					</div>
				</div>
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