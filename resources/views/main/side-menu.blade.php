<?php use App\TagModel; ?>
<?php use App\ProfileModel; ?>
<?php if (Auth::id()) { $id = Auth::id(); } else { $id = 0; } ?>
<div id="home-side-object">
	<div class="place-notif">
		<div class="place-notif-ctn">
			<div class="ctn-main-font ctn-min-color ctn-16px padding-bottom-10px">
				<strong class="ttl">Create your Opinion</strong>
			</div>
			<div class="ctn-main-font ctn-sek-color ctn-14px padding-bottom-15px">
				<p>Let's start to post your opinion. It's easy to use and that's all free for you...</p>
			</div>
			<a href="{{ url('/compose') }}">
				<button class="create btn btn-main3-color width-all" onclick="opCompose('open');">
					<span class="fas fa-lg fa-plus"></span>
					<span>Create your Opinion</span>
				</button>
			</a>
		</div>
	</div>
	<div class="place-notif">
		<div class="ttl-head padding-15px">
			<div class="ctn-main-font ctn-min-color ctn-16px">
				Who's to follows
			</div>
		</div>
		<div class="place-notif-ctn">
			@foreach(ProfileModel::TopUsers($id, 10) as $p)
				@include('main.frame-follow')
			@endforeach
		</div>
	</div>
	<div class="place-notif">
		<div class="ttl-head padding-15px">
			<div class="ctn-main-font ctn-min-color ctn-16px">
				Tranding now's
			</div>
		</div>
		<div class="place-notif-ctn">
			@foreach(TagModel::TopTags(10) as $tag)
				<?php 
					$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
					$title = str_replace($replace, '', $tag->tag); 
				?>
				<div class="frame-trending">
					<div>
						<a href="{{ url('/tags/'.$title) }}" class="ctn-main-font ctn-reg-color ctn-link ctn-desc ctn-hover-underline">
							{{ $tag->tag }}
						</a>
					</div>
					<div class="ctn-main-font ctn-sek-color ctn-link ctn-14px ctn-thin">{{ $tag->ttl_tag }} Stories</div>
				</div>
			@endforeach
		</div>
	</div>
	<div id="footer" class="padding-bottom-15px">
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