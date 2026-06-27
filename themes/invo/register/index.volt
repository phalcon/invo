<div class="container" style="max-width:560px;">
    <div class="page-head"><div><h1>Create an account</h1><div class="sub">Start invoicing for free.</div></div></div>
    <form class="form-card" action="{{ url('register') }}" id="registerForm" method="post">
        <div class="field">
            {{ form.label('name', ['class': 'field-label']) }}
            {{ form.render('name', ['class': 'form-control']) }}
            <div class="alert alert-danger" id="name_alert" style="display:none;margin:8px 0 0;">Please enter your full name</div>
        </div>
        <div class="field">
            {{ form.label('username', ['class': 'field-label']) }}
            {{ form.render('username', ['class': 'form-control']) }}
            <div class="alert alert-danger" id="username_alert" style="display:none;margin:8px 0 0;">Please enter your desired user name</div>
        </div>
        <div class="field">
            {{ form.label('email', ['class': 'field-label']) }}
            {{ form.render('email', ['class': 'form-control']) }}
            <div class="alert alert-danger" id="email_alert" style="display:none;margin:8px 0 0;">Please enter your email</div>
        </div>
        <div class="field">
            {{ form.label('password', ['class': 'field-label']) }}
            {{ form.render('password', ['class': 'form-control']) }}
            <div class="alert alert-danger" id="password_alert" style="display:none;margin:8px 0 0;">Please provide a valid password</div>
        </div>
        <div class="field">
            <label class="field-label" for="repeatPassword">Repeat password</label>
            {{ password_field('repeatPassword', 'class': 'form-control') }}
            <div class="alert alert-danger" id="repeatPassword_alert" style="display:none;margin:8px 0 0;">The password does not match</div>
        </div>
        {{ tag.inputSubmit('Register', null, ['class': 'btn btn-primary', 'id': null, 'name': null, 'value': 'Sign up', 'onclick': 'return SignUp.validate();']) }}
        <p style="font-size:12.5px;color:var(--muted);margin-top:14px;">By signing up, you accept the terms of use and privacy policy.</p>
    </form>
</div>
