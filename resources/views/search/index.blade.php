@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				<div class="bdr-bottom padding-15px">
					<div>
					@if (count($topTags) != 0)
						<div class="sc-header">
							<div class="sc-place">
								<div>
									<div class="place-search-tag">
										<div class="st-lef">
											<div class="btn btn-circle btn-sekunder-color btn-no-border" onclick="toLeft()">
												<span class="fa fa-lg fa-angle-left"></span>
											</div>
										</div>
										<div class="st-mid" id="ctnTag">
											@foreach ($topTags as $tag)
											<?php 
												$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
												$title = str_replace($replace, '', $tag->tag); 
											?>
											<a href="{{ url('/tags/'.$title) }}">
												<div class="frame-top-tag">
													{{ $tag->tag }}
												</div>
											</a>
											@endforeach 
										</div>
										<div class="st-rig">
											<div class="btn btn-circle btn-sekunder-color btn-no-border" onclick="toRight()">
												<span class="fa fa-lg fa-angle-right"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
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