<div id="topMenu">
	<ul class="nav">
	    <li><a href="/" title="Pradzia">Pradžia</a></li>
		@guest
		@else
			@if(Auth::user()->hasRole('Klientas'))
				<li><a href="/klientouzsakymai" title="Uzsakymai">Jūsų užsakymai</a></li>
			@endif
			@if(Auth::user()->hasRole('Administratorius'))
			<li><a href="/darbuotojai" title="Darbuotojai">Darbuotojai</a></li>
			<li><a href="/keliones/prideti/nauja" title="Keliones">Nauja kelionė</a></li>
			<li class="dropdown"><a href="#">Paslaugos<span class="caret"></span>
			</a>
			<div class="dropdown-content">
				<a href="/draudimai/prideti">Naujas draudimas</a>
				<a href="/ekskursijos/prideti">Nauja ekskursija</a>
				<a href="/automobiliai/prideti">Naujas automobilis</a>
				<a href="/viesbuciai/prideti">Naujas viešbutis</a>
			</div>
			</li>
			<li><a href="/miestai/prideti" title="Miestai">Naujas miestas</a></li>
			@endif
			@if(Auth::user()->hasRole('Darbuotojas'))
				<li><a href="/sutartys/patvirtinimai/tikrinti" title="klientuSutartys">Klientų sutartys</a></li>
			@endif
			@if(Auth::user()->hasRole('Administratorius') || Auth::user()->hasRole('Darbuotojas'))
			<li class="dropdown"><a href="#">Ataskaitos<span class="caret"></span></a>
			<div class="dropdown-content">
				<a href="/ataskaitos/populiariausiossalys">Populiariausios šalys</a>
				<a href="">Neapmokėtos sutartys</a>
				<a href="">Vidutinės kelionių kainos</a>
				<a href="">Populiariausios paslaugos</a>
				<a href="">Bendra kelionių suma</a>
			</div>
			</li>
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