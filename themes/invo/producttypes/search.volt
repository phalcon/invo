<div class="page-head">
    <div><h1>Product types</h1><div class="sub">Search results.</div></div>
    <a class="btn btn-primary" href="{{ url('producttypes/new') }}">+ New type</a>
</div>
<table class="data-table" style="max-width:620px;">
    <thead><tr><th>ID</th><th>Name</th><th></th></tr></thead>
    <tbody>
    {% for producttype in page.items %}
        <tr>
            <td class="id">{{ producttype.id }}</td>
            <td class="name">{{ producttype.name }}</td>
            <td class="actions">
                <a href="{{ url('producttypes/edit/' ~ producttype.id) }}">Edit</a>
                <a class="del" href="{{ url('producttypes/delete/' ~ producttype.id) }}">Delete</a>
            </td>
        </tr>
    {% else %}
        <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:28px;">No product types are recorded.</td></tr>
    {% endfor %}
    </tbody>
</table>
{% if page.getLast() > 1 %}
<div style="display:flex;gap:8px;align-items:center;margin-top:16px;font-size:13px;">
    <a class="btn btn-secondary" href="{{ url('producttypes/search?page=' ~ page.getPrevious()) }}">← Prev</a>
    <span style="color:var(--muted);">{{ page.getCurrent() }} / {{ page.getLast() }}</span>
    <a class="btn btn-secondary" href="{{ url('producttypes/search?page=' ~ page.getNext()) }}">Next →</a>
</div>
{% endif %}
