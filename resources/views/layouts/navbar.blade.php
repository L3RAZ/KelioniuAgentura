<div id="topMenu">
	<ul class="nav">
	    <li><a href="/" title="Pradzia">Pradžia</a></li>
		<!-- rodo tik klientui -->
		<li><a href="/klientouzsakymai" title="Uzsakymai">Jūsų užsakymai</a></li>
		<!-- rodo tik adminui -->
		<li><a href="" title="Darbuotojai">Darbuotojai</a></li>
		<li><a href="" title="Keliones">Kelionės</a></li>
		<li><a href="" title="Viesbuciai">Viešbučiai</a></li>
		<li><a href="" title="Paslaugos">Paslaugos</a></li>
		<!-- rodo tik darbuotojui -->
		<li><a href="" title="klientuSutartys">Klientų sutartys</a></li>

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
		</li
		@endguest
	</ul>
</div>