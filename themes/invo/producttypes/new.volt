<form action="/producttypes/create" role="form" method="post">
    <ul class="pager">
        <li class="previous pull-left">
            {{ tag.a(url('producttypes'), '&larr; Go Back', [], true) }} 
        </li>
        <li class="pull-right">
            {{ tag.inputSubmit('Save', 'Save', ['class': 'btn btn-success', 'id':null, 'name':null]) }} 
        </li>
    </ul>

    <div class="center scaffold">
        <h2>Create product types</h2>

        <div class="clearfix">
            <label for="name">Name</label>
            {{ tag.inputText('name', '', ['size': 24, 'maxlength': 70]) }} 
        </div>
    </div>
</form>
