<div class="page-head"><div><h1>Update your profile</h1><div class="sub">Manage how you appear on invoices.</div></div></div>
<form class="form-card" action="{{ url('invoices/profile') }}" method="post" id="profileForm" style="max-width:560px;">
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:26px;">
        <span class="avatar" style="width:54px;height:54px;border-radius:14px;background:var(--ink);color:#fff;font-size:18px;font-family:var(--serif);">PD</span>
        <div><div style="font-size:16px;font-weight:700;">Phalcon Demo</div><div style="font-size:13px;color:var(--muted);">Administrator</div></div>
    </div>
    <div class="field">
        {{ form.label('name', ['class': 'field-label']) }}
        {{ form.render('name', ['class': 'form-control']) }}
        <div class="alert alert-danger" id="name_alert" style="display:none;margin:8px 0 0;">Please enter your full name</div>
    </div>
    <div class="field">
        {{ form.label('email', ['class': 'field-label']) }}
        {{ form.render('email', ['class': 'form-control']) }}
        <div class="alert alert-danger" id="email_alert" style="display:none;margin:8px 0 0;">Please enter your email</div>
    </div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('invoices/index') }}">Cancel</a>
        <input type="button" value="Update" class="btn btn-primary" onclick="Profile.validate()">
    </div>
</form>
