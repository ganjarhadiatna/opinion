<div class="frame-post">
	<div class="mid">
		<div class="pos top-tool padding-bottom-10px">
			<div class="grid grid-3x">
				<div class="grid-1">
					<a href="{{ url('/user/'.$story->id) }}">
						<div class="image image-35px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
					</a>
				</div>
				<div class="grid-2">
					<div class="ttl-story">
						<a href="{{ url('/user/'.$story->id) }}" class="ctn-main-font ctn-min-color ctn-16px">
							{{ $story->username }}
						</a>
					</div>
				</div>
				<div class="grid-3">
					<button class="icn btn btn-circle btn-primary-color" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}')">
						<span class="fa fa-lg fa-ellipsis-h"></span>
					</button>
				</div>
			</div>
		</div>
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
		@if (!empty($story->ttl_image))
			<div class="mid-tool padding-bottom-15px">
				<div class="cover"></div>
				@if ($story->ttl_image == 1)
				<a href="{{ url('/story/'.$story->idstory) }}">
					<div class="cover-theme cover-theme-1">
						<div class="image image-all image-radius"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover1) }});"></div>
					</div>
				</a>
				@elseif ($story->ttl_image <= 4)
				<a href="{{ url('/story/'.$story->idstory) }}">
					<div class="cover-theme cover-theme-2">
						<div class="image image-full"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover1) }});"></div>
						<div class="image image-full"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover2) }});"></div>
					</div>
				</a>
				@else
				<a href="{{ url('/story/'.$story->idstory) }}">
					<div class="cover-theme cover-theme-2">
						<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover1) }});"></div>
						<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover2) }});"></div>
						<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover3) }});"></div>
						<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover4) }});"></div>
					</div>
				</a>
				@endif
				@if ($story->ttl_image > 1)
					<div class="icn-image">
						<span class="fa fa-lg fa-camera"></span>
						<span>{{ $story->ttl_image }}</span>
					</div>
				@endif
			</div>
		@endif
		<div class="padding-bottom-15px">
			<div class="menu-val">
				<ul class="no-pad ctn-main-font ctn-14px">
					<li>{{ $story->ttl_comment.' Comments' }}</li>
					<li><span class="icn fa fa-1x fa-circle"></span></li>
					<li>{{ $story->ttl_love.' Agree' }}</li>
					@if ($story->id == Auth::id())
						<li><span class="icn fa fa-1x fa-circle"></span></li>
						<li>{{ $story->ttl_save.' Saves' }}</li>
					@endif
					<li><span class="icn fa fa-1x fa-circle"></span></li>
					<li>{{ date('F d, Y h:i:sa', strtotime($story->created)) }}</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="pos bot-tool">
		<div class="nts">
			<!--
			<button class="btn btn-sekunder-color btn-radius" title="share your opinions?">
				<span class="fas fa-lg fa-plus"></span>
				<span>Give Opinion</span>
			</button>
			-->
			@if (is_int($story->is_love))
				<button class="btn btn-sekunder-color btn-radius love love-{{ $story->idstory }}" 
					title="Agree with this opinion?" 
					onclick="addLove('{{ $story->idstory }}')">
					<span class="icn-love-{{ $story->idstory }} fas fa-lg fa-thumbs-up"></span>
					<span>Agree</span>
				</button>
			@else
				<button class="btn btn-sekunder-color btn-radius love-{{ $story->idstory }}" 
					title="Agree with this opinion?" 
					onclick="addLove('{{ $story->idstory }}')">
					<span class="icn-love-{{ $story->idstory }} far fa-lg fa-thumbs-up"></span>
					<span>Agree</span>
				</button>
			@endif
		</div>
		<div class="bok">
			<a href="{{ url('/story/'.$story->idstory) }}">
				<button class="btn btn-circle btn-sekunder-color">
					<span class="far fa-lg fa-comment"></span>
				</button>
			</a>
			<button class="btn btn-circle btn-sekunder-color save"
				key="{{ $story->idstory }}" 
				onclick="addBookmark('{{ $story->idstory }}')">
				@if (is_int($story->is_save))
					<span class="bookmark-{{ $story->idstory }} fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
				@else
					<span class="bookmark-{{ $story->idstory }} far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
				@endif
			</button>
		</div>
	</div>
</div>