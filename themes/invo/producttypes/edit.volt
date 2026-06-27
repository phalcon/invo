<div class="page-head">
    <div><h1>Edit product type</h1><div class="sub">Rename this category.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('producttypes') }}">Cancel</a>
        <button class="btn btn-primary" type="submit" form="type-form">Save type</button>
    </div>
</div>
<form id="type-form" class="form-card" action="{{ url('producttypes/save') }}" method="post">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}{{ element }}{% else %}
        <div class="field">{{ element.label() }}{{ element.render(['class': 'form-control']) }}</div>
        {% endif %}
    {% endfor %}
</form>
