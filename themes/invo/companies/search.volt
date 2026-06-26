<div class="page-head">
    <div><h1>Companies</h1><div class="sub">Search results.</div></div>
    <a class="btn btn-primary" href="{{ url('companies/new') }}">+ New company</a>
</div>
<table class="data-table">
    <thead><tr><th>ID</th><th>Name</th><th>Telephone</th><th>City</th><th></th></tr></thead>
    <tbody>
    {% for company in page.items %}
        <tr>
            <td class="id">{{ company.id }}</td>
            <td class="name">{{ company.name }}</td>
            <td style="color:var(--muted);font-family:var(--mono);font-size:13px;">{{ company.telephone }}</td>
            <td style="color:var(--muted);">{{ company.city }}</td>
            <td class="actions">
                <a href="{{ url('companies/edit/' ~ company.id) }}">Edit</a>
                <a class="del" href="{{ url('companies/delete/' ~ company.id) }}">Delete</a>
            </td>
        </tr>
    {% else %}
        <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:28px;">No companies were found.</td></tr>
    {% endfor %}
    </tbody>
</table>
{% if page.getLast() > 1 %}
<div style="display:flex;gap:8px;align-items:center;margin-top:16px;font-size:13px;">
    <a class="btn btn-secondary" href="{{ url('companies/search?page=' ~ page.getPrevious()) }}">← Prev</a>
    <span style="color:var(--muted);">{{ page.getCurrent() }} / {{ page.getLast() }}</span>
    <a class="btn btn-secondary" href="{{ url('companies/search?page=' ~ page.getNext()) }}">Next →</a>
</div>
{% endif %}
