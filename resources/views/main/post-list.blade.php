<div class="frame-post">
	<div class="mid">
		<div class="padding-bottom-5px"></div>
		<div class="padding-bottom-15px">
			@if ($story->description)
				<a href="{{ url('/story/'.$story->idstory) }}">
					<div class="ctn-main-font ctn-min-color ctn-desc ctn-link">
						{{ $story->description }}
					</div>
				</a>
			@endif
		</div>
		<div>
			<div class="menu-val">
				<ul class="no-pad ctn-main-font ctn-14px">
					<li>{{ $story->ttl_comment.' Comments' }}</li>
					<li><span class="icn fa fa-1x fa-circle"></span></li>
					<li>{{ $story->ttl_love.' Agree' }}</li>
					<li><span class="icn fa fa-1x fa-circle"></span></li>
					<li>{{ $story->ttl_save.' Saves' }}</li>
					<li><span class="icn fa fa-1x fa-circle"></span></li>
					<li>{{ date('F d, Y h:i:sa', strtotime($story->created)) }}</li>
				</ul>
			</div>
		</div>
	</div>
</div>