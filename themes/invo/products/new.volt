<div class="page-head">
    <div><h1>New product</h1><div class="sub">Add an item you can invoice.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('products') }}">Cancel</a>
        <button class="btn btn-primary" type="submit" form="product-form">Save product</button>
    </div>
</div>
<form id="product-form" class="form-card" action="{{ url('products/create') }}" method="post">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}{{ element }}{% else %}
        <div class="field">{{ element.label() }}{{ element.render(['class': 'form-control']) }}</div>
        {% endif %}
    {% endfor %}
</form>
