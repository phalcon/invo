
{{ content() }}

<div align="right">
    {{ link_to("companies/new", "Create Companies", "class": "btn btn-primary") }}
</div>

<form method="post" action="{{ url("companies/search") }}">

<div class="center scaffold">

    <h2>Search companies</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        {{ form.render("id") }}
    </div>

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

    <div class="clearfix">
        {{ submit_button("Search", "class": "btn btn-primary") }}
    </div>

</div>

</form>
