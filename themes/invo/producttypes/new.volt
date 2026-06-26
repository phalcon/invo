<div class="page-head">
    <div><h1>New product type</h1><div class="sub">Name a category for your products.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('producttypes') }}">Cancel</a>
        <button class="btn btn-primary" type="submit" form="type-form">Save type</button>
    </div>
</div>
<form id="type-form" class="form-card" action="{{ url('producttypes/create') }}" method="post">
    <div class="field"><label class="field-label" for="name">Name</label>{{ tag.inputText('name', '', ['class': 'form-control']) }}</div>
</form>
