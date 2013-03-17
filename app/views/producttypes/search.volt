<?php use Phalcon\Tag as Tag ?>

<?php echo $this->getContent() ?>

<ul class="pager">
    <li class="previous pull-left">
        <?php echo Tag::linkTo("producttypes/index", "&larr; Go Back") ?>
    </li>
    <li class="pull-right">
        <?php echo Tag::linkTo(array("producttypes/new", "Create product types", "class" => "btn btn-primary")) ?>
    </li>
</ul>

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($page->items)){
            foreach($page->items as $productType){ ?>
        <tr>
            <td><?php echo $productType->id ?></td>
            <td><?php echo $productType->name ?></td>
            <td width="12%"><?php echo Tag::linkTo(array("producttypes/edit/".$productType->id, '<i class="icon-pencil"></i> Edit', "class" => "btn")) ?></td>
            <td width="12%"><?php echo Tag::linkTo(array("producttypes/delete/".$productType->id, '<i class="icon-remove"></i> Delete', "class" => "btn")) ?></td>
        </tr>
    <?php }
        } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="4" align="right">
                <div class="btn-group">
                    <?php echo Tag::linkTo(array("producttypes/search", '<i class="icon-fast-backward"></i> First', "class" => "btn")) ?>
                    <?php echo Tag::linkTo(array("producttypes/search?page=".$page->before, '<i class="icon-step-backward"></i> Previous', "class" => "btn ")) ?>
                    <?php echo Tag::linkTo(array("producttypes/search?page=".$page->next, '<i class="icon-step-forward"></i> Next', "class" => "btn")) ?>
                    <?php echo Tag::linkTo(array("producttypes/search?page=".$page->last, '<i class="icon-fast-forward"></i> Last', "class" => "btn")) ?>
                    <span class="help-inline"><?php echo $page->current, "/", $page->total_pages ?></span>
                </div>
            </td>
        </tr>
    <tbody>
</table>