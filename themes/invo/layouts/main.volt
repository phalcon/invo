{% set controller = dispatcher.getControllerName()|lower %}
{% set action = dispatcher.getActionName()|lower %}
{% set isAuth = session.has('auth') %}
{% set isLogin = controller == 'session' %}
{% set appControllers = ['invoices', 'companies', 'products', 'producttypes'] %}
{% set isApp = isAuth and controller in appControllers %}
{% if isLogin %}
    {{ content() }}
{% else %}
    <div class="app-nav">
        <div class="app-nav__left">
            <a class="brand" href="{{ url('/') }}">
                <span class="brand__mark">i</span><span class="brand__name">INVO</span>
            </a>
            {% if isApp %}
            <nav class="nav-links">
                <a href="{{ url('invoices/index') }}" class="{{ controller == 'invoices' ? 'active' : '' }}">Invoices</a>
                <a href="{{ url('companies/index') }}" class="{{ controller == 'companies' ? 'active' : '' }}">Companies</a>
                <a href="{{ url('products/index') }}" class="{{ controller in ['products', 'producttypes'] ? 'active' : '' }}">Products</a>
                <a href="{{ url('invoices/profile') }}" class="{{ action == 'profile' ? 'active' : '' }}">Profile</a>
            </nav>
            {% else %}
            <nav class="nav-links">
                <a href="{{ url('index') }}" class="{{ controller == 'index' ? 'active' : '' }}">Home</a>
                <a href="{{ url('about/index') }}" class="{{ controller == 'about' ? 'active' : '' }}">About</a>
                <a href="{{ url('contact/index') }}" class="{{ controller == 'contact' ? 'active' : '' }}">Contact</a>
            </nav>
            {% endif %}
        </div>
        <div class="app-nav__right">
            {% if isAuth %}
                <a class="nav-logout" href="{{ url('session/end') }}">Log out</a>
                <span class="avatar">PD</span>
            {% else %}
                <a class="nav-cta" href="{{ url('session/index') }}">Log in / Sign up</a>
            {% endif %}
        </div>
    </div>

    {% if isApp %}
        <div class="container">
            {{ flash.output() }}
            {{ content() }}
        </div>
    {% else %}
        <div class="flash-wrap">{{ flash.output() }}</div>
        {{ content() }}
    {% endif %}

    <footer class="app-footer">&copy; Company {{ date('Y') }} - Built on Phalcon</footer>
{% endif %}
