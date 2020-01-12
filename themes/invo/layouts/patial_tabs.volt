{% set tabs = [
    'invoices': [
        'title': 'Invoices',
        'uri': '/invoices/index'
    ],
    'companies': [
        'title': 'Companies',
        'uri': '/companies/index'
    ],
    'products': [
        'title': 'Products',
        'uri': '/products/index'
    ],
    'producttypes': [
        'title': 'Product Types',
        'uri': '/producttypes/index'
    ],
    'invoices': [
        'title': 'Your Profile',
        'uri': '/invoices/profile'
    ]
] %}

<ul class="nav nav-tabs mb-3">
    {% for controller, tab in tabs %}
        <li class="nav-item">
            <a class="nav-link {% if controller == dispatcher.getControllerName()|lower %}active{% endif %}" href="{{ tab['uri'] }}">
                {{ tab['title'] }}
            </a>
        </li>
    {% endfor %}
</ul>
