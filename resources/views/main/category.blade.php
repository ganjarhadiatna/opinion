@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		//$('#main-search').show();
	});
</script>
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				<div class="ttl-head padding-15px">
					<div class="ctn-main-font ctn-min-color ctn-16px">
						Categories
					</div>
				</div>
				<div class="ctr">
					<ul>
						<li>
							<a href="{{ url('/') }}" class="ctn-main-font ctn-sek-color ctn-14px">
								Home Feeds
							</a>
						</li>
						<li>
							<a href="{{ url('/fresh') }}" class="ctn-main-font ctn-sek-color ctn-14px">
								Fresh
							</a>
						</li>
						<li>
							<a href="{{ url('/popular') }}" class="ctn-main-font ctn-sek-color ctn-14px">
								Popular
							</a>
						</li>
						<li>
							<a href="{{ url('/trending') }}" class="ctn-main-font ctn-sek-color ctn-14px">
								Trending
							</a>
						</li>
						@foreach ($allTags as $tag)
							<?php 
								$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
								$title = str_replace($replace, '', $tag->tag); 
							?>
							<li>
								<a href="{{ url('/tags/'.$title) }}" class="ctn-main-font ctn-sek-color ctn-14px">
									{{ $tag->tag }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="rig post-grid-2">
			@include('main.side-menu')
		</div>
	</div>
</div>
@endsection