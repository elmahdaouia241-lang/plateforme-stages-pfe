<h1>Dashboard Encadrant</h1>

<p>Bienvenue {{ auth()->user()->name }}</p>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button>Logout</button>
</form>
