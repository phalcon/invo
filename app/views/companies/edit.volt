
<form method="post" action="{{ url("companies/save") }}">

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("companies", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Edit companies</h2>

    {{ form.render("id") }}

    <div class="clearfix">
        <label for="name">Name</label>
        {{ form.render("name") }}
    </div>

    <div class="clearfix">
        <label for="telephone">Telephone</label>
        {{ form.render("telephone") }}
    </div>

    <div class="clearfix">
        <label for="address">Address</label>
        {{ form.render("address") }}
    </div>

    <div class="clearfix">
        <label for="city">City</label>
        {{ form.render("city") }}
    </div>

    </form>
</div>
