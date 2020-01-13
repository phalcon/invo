{% set tabs = [
    [
        'controller': 'invoices',
        'action': 'index',
        'title': 'Invoices',
        'uri': '/invoices/index'
    ],
    [
        'controller': 'companies',
        'action': 'index',
        'title': 'Companies',
        'uri': '/companies/index'
    ],
    [
        'controller': 'products',
        'action': 'index',
        'title': 'Products',
        'uri': '/products/index'
    ],
    [
        'controller': 'producttypes',
        'action': 'index',
        'title': 'Product Types',
        'uri': '/producttypes/index'
    ],
    [
        'controller': 'invoices',
        'action': 'profile',
        'title': 'Your Profile',
        'uri': '/invoices/profile'
    ]
] %}

<ul class="nav nav-tabs mb-3">
    {% for controller, tab in tabs %}
        <li class="nav-item">
            <a class="nav-link {% if tab['controller'] == dispatcher.getControllerName()|lower and tab['action'] == dispatcher.getActionName() %}active{% endif %}" href="{{ tab['uri'] }}">
                {{ tab['title'] }}
            </a>
        </li>
    {% endfor %}
</ul>
