<div class="page-head">
    <div><h1>Companies</h1><div class="sub">The customers you invoice.</div></div>
    <a class="btn btn-primary" href="{{ url('companies/new') }}">+ New company</a>
</div>
<form class="form-card" action="{{ url('companies/search') }}" method="post">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}{{ element }}{% else %}
        <div class="field">{{ element.label() }}{{ element.render(['class': 'form-control']) }}</div>
        {% endif %}
    {% endfor %}
    <button class="btn btn-dark" type="submit">Search</button>
</form>
