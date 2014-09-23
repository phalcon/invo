{{ form('producttypes/save') }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("producttypes", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Edit product types</h2>
    
    <input type="hidden" name="id" id="id" value="{{ id }}" />

    <div class="clearfix">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

</div>
</form>
