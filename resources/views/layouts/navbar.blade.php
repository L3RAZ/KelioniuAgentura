<div id="topMenu">
	<ul class="nav">
	    <li><a href="/" title="Home">Home</a></li>
		<li><a href="/clients" title="Clients">Clients</a></li>
		<li><a href="/animals" title="Animals">Animals</a></li>
		<li><a href="/contracts" title="Contracts">Contracts</a></li>
		<li><a href="/employees" title="Employees">Employees</a></li>
		<li><a href="/stores" title="Stores">Stores</a></li>

		@guest
		<li style="float:right"><a href="{{ route('login') }}">Login</a></li>
		<li style="float:right"><a href="{{ route('register') }}">Register</a></li>
		@else
		<li class="dropdown" style="float:right">
			<a href="#">
				{{ Auth::user()->name }} <span class="caret"></span>
			</a>
		
			<div class="dropdown-content">
			<a href="/korteles">Mano kortelės</a>
					<a href="{{ route('logout') }}"
						onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
						Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

			</div>
		</li
		@endguest
	</ul>
</div>