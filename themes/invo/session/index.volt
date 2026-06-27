<div class="login">
    <div class="login__brand">
        <a class="brand" href="{{ url('/') }}"><span class="brand__mark">i</span><span class="brand__name">INVO</span></a>
        <div class="login__spacer">
            <h2>Invoices, kept<br>in good order.</h2>
            <p>Create, send and track every invoice - and always know who has paid.</p>
            <div style="display:flex;align-items:center;gap:8px;opacity:.7;">
                <img src="{{ url('img/falcon.svg') }}" width="18" height="18" alt="">
                <span style="font-size:11.5px;letter-spacing:.04em;color:var(--on-dark-muted);">Built on Phalcon</span>
            </div>
        </div>
    </div>
    <div class="login__form">
        <div class="box">
            <h1>Log in</h1>
            <p class="lead">Welcome back to your books.</p>
            {{ flash.output() }}
            <form action="{{ url('session/start') }}" method="post">
                <label class="field-label">Username or email</label>
                {{ form.render('email', ['class': 'input']) }}
                <label class="field-label">Password</label>
                {{ form.render('password', ['class': 'input']) }}
                <button class="btn btn-primary" type="submit">Log in</button>
            </form>
            <div style="text-align:center;font-size:13.5px;color:#736a5d;margin-top:20px;">Don't have an account? <a href="{{ url('register') }}" style="font-weight:700;">Sign up</a></div>
        </div>
    </div>
</div>
