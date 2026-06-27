<div class="container" style="max-width:560px;">
    <div class="page-head"><div><h1>Contact</h1><div class="sub">Send us a message and let us know how we can help.</div></div></div>
    <form class="form-card" action="{{ url('contact/send') }}" method="post">
        <div class="field">{{ form.label('name') }}{{ form.render('name', ['class': 'form-control']) }}</div>
        <div class="field">{{ form.label('email') }}{{ form.render('email', ['class': 'form-control']) }}</div>
        <div class="field">{{ form.label('comments') }}{{ form.render('comments', ['class': 'form-control']) }}</div>
        <button class="btn btn-primary" type="submit">Send message</button>
    </form>
</div>
