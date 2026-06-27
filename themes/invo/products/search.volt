<div class="page-head">
    <div><h1>Products</h1><div class="sub">Search results.</div></div>
    <div class="form-actions">
        <a class="btn btn-secondary" href="{{ url('producttypes/index') }}">Product types →</a>
        <a class="btn btn-primary" href="{{ url('products/new') }}">+ New product</a>
    </div>
</div>
<table class="data-table">
    <thead><tr><th>ID</th><th>Name</th><th>Type</th><th class="right">Price</th><th></th></tr></thead>
    <tbody>
    {% for product in page.items %}
        <tr>
            <td class="id">{{ product.id }}</td>
            <td class="name">{{ product.name }}</td>
            <td><span class="badge-type">{{ product.productTypes.name }}</span></td>
            <td class="num">${{ "%.2f"|format(product.price) }}</td>
            <td class="actions">
                <a href="{{ url('products/edit/' ~ product.id) }}">Edit</a>
                <a class="del" href="{{ url('products/delete/' ~ product.id) }}">Delete</a>
            </td>
        </tr>
    {% else %}
        <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:28px;">No products are recorded.</td></tr>
    {% endfor %}
    </tbody>
</table>
{% if page.getLast() > 1 %}
<div style="display:flex;gap:8px;align-items:center;margin-top:16px;font-size:13px;">
    <a class="btn btn-secondary" href="{{ url('products/search?page=' ~ page.getPrevious()) }}">← Prev</a>
    <span style="color:var(--muted);">{{ page.getCurrent() }} / {{ page.getLast() }}</span>
    <a class="btn btn-secondary" href="{{ url('products/search?page=' ~ page.getNext()) }}">Next →</a>
</div>
{% endif %}
