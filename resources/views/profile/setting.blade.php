@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="place-notif col-600px">
	<div class="ttl-head padding-15px">
		<div class="ctn-main-font ctn-min-color ctn-16px">
			Settings
		</div>
	</div>
	<div class="frame-edit compose" id="create">
		<div class="main">
			<div class="edit-body">
				<div class="edit-block">
					<p>Account</p>
					<ul>
						<a href="{{ url('/me/setting/profile') }}">
						    <li>
						    	<span class="ed-1">
						    		Edit Profile
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
					    </a>
					    <a href="{{ url('/me/setting/password') }}">
						    <li>
						    	<span class="ed-1">
						    		Change Password
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
						</a>
					</ul>
				</div>
				<div class="edit-block">
					<p>Others</p>
					<ul>
					    <li>
					    	<span class="ed-1">
					    		Delete this Account
					    	</span>
					    	<span class="ed-2">
					    		<span class="fa fa-lg fa-trash-o"></span>
					    	</span>
					    </li>
					    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					    <a href="{{ route('logout') }}" 
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
						    <li>
						    	<span class="ed-1">
						    		Logout
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-power-off"></span>
						    	</span>
						    </li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="padding-bottom-15px"></div>
</div>
<div class="padding-bottom-15px"></div>
@endsection