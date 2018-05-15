<div id="home-side-object">
	<div class="frame-other">
		<strong class="ttl">Create your Opinion</strong>
		<p>Let's start to post your opinion. It's easy to use and that's all free for you...</p>
		<div class="padding-10px">
			<a href="{{ url('/compose') }}">
				<button class="create btn btn-main3-color width-all" onclick="opCompose('open');">
					<span class="fas fa-lg fa-plus"></span>
					<span>Create your Opinion</span>
				</button>
			</a>
		</div>
	</div>
	<div class="padding-bottom-15px"></div>
	<div class="frame-other">
		<strong class="ttl">Who to Follows</strong>
		@foreach($topUsers as $p)
			@include('main.frame-follow')
		@endforeach
	</div>
	<div class="padding-bottom-15px"></div>
	<div class="frame-other">
		<strong class="ttl">Tranding Nows</strong>
		<div>
        @foreach($topTags as $tag)
			<?php 
				$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
				$title = str_replace($replace, '', $tag->tag); 
			?>
			<div class="frame-trending">
				<div class="ttl-head">
					<a href="{{ url('/tags/'.$title) }}">
                        {{ $tag->tag }}
					</a>
				</div>
				<div class="ttl-ctn">{{ $tag->ttl_tag }} Stories</div>
			</div>
        @endforeach
		</div>
	</div>
	<div id="footer">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home Feeds</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">About Us</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">Privacy</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">Terms</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">Policy</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">FAQ</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">Jobs</a>
			</li>
			<li><span class="icn fa fa-lg fa-circle"></span></li>
			<li>
				<a href="#">Help</a>
			</li>
		</ul>
	</div>
</div>