<div id="topMenu">
	<ul class="nav">
	    <li><a href="/" title="Pradzia">Pradžia</a></li>
		@guest
		@else
			@if(Auth::user()->hasRole('Klientas'))
			<li><a href="/klientouzsakymai" title="Uzsakymai">Jūsų užsakymai</a></li>
			@endif
			@if(Auth::user()->hasRole('Administratorius'))
			<li><a href="" title="Darbuotojai">Darbuotojai</a></li>
			<li><a href="/keliones/prideti/nauja" title="Keliones">Kelionės</a></li>
			<li class="dropdown"><a href="#">Paslaugos<span class="caret"></span>
			</a>
			<div class="dropdown-content">
				<a href="/korteles">Naujas draudimas</a>
				<a href="/korteles">Nauja ekskursija</a>
				<a href="/korteles">Naujas automobilis</a>
				<a href="/korteles">Naujas viešbutis</a>
			</div>
			</li>

			@endif
			@if(Auth::user()->hasRole('Darbuotojas'))
			<li><a href="/sutartys/patvirtinimai/tikrinti" title="klientuSutartys">Klientų sutartys</a></li>
			@endif
		@endguest
		@guest
		<li style="float:right"><a href="{{ route('login') }}">Prisijungti</a></li>
		<li style="float:right"><a href="{{ route('register') }}">Registracija</a></li>
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
						Atsijungti
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

			</div>
		</li>
		@endguest
	</ul>
</div>