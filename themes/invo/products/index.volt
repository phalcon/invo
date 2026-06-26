<div class="page-head">
    <div><h1>Products</h1><div class="sub">The items you put on invoices.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('producttypes/index') }}">Product types →</a>
        <a class="btn btn-primary" href="{{ url('products/new') }}">+ New product</a>
    </div>
</div>
<form class="form-card" action="{{ url('products/search') }}" method="post">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}{{ element }}{% else %}
        <div class="field">{{ element.label() }}{{ element.setAttribute("class", "form-control") }}</div>
        {% endif %}
    {% endfor %}
    <button class="btn btn-dark" type="submit">Search</button>
</form>
