<div class="page-head">
    <div><h1>New company</h1><div class="sub">Add a customer you invoice.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('companies') }}">Cancel</a>
        <button class="btn btn-primary" type="submit" form="company-form">Save company</button>
    </div>
</div>
<form id="company-form" class="form-card" action="{{ url('companies/create') }}" method="post">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}{{ element }}{% else %}
        <div class="field">{{ element.label() }}{{ element.render(['class': 'form-control']) }}</div>
        {% endif %}
    {% endfor %}
</form>
