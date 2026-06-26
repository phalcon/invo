<div class="page-head">
    <div><h1>Product types</h1><div class="sub">Group your products into categories.</div></div>
    <a class="btn btn-primary" href="{{ url('producttypes/new') }}">+ New type</a>
</div>
<form class="form-card" action="{{ url('producttypes/search') }}" method="post">
    <div class="field"><label class="field-label" for="id">Id</label>{{ tag.inputNumeric('id', '', ['class': 'form-control']) }}</div>
    <div class="field"><label class="field-label" for="name">Name</label>{{ tag.inputText('name', '', ['class': 'form-control']) }}</div>
    <button class="btn btn-dark" type="submit">Search</button>
</form>
