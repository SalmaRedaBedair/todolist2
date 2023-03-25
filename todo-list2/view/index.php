<?php 

include_once('up.php');

$jsonArray=[];
if(file_exists('todo.json')){
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json,true);
}else {
    echo "please check json file";
    die();
}
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>add new task</strong>
        </div>
        <div class="card-body card-block">
            <form action="newTodo.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">task name</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="taskName" name="taskName" placeholder="Enter new task"
                            class="form-control">
                        <!-- <small class="form-text text-muted">This is a help text</small> -->
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>
        </form>
    </div>
</div>

<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">task</th>
                <th scope="col">options</th>
                
            </tr>
        </thead>
        <tbody>
        <?php 
        if(isset($jsonArray))
        foreach($jsonArray as $data=>$value):
            // var_dump($value);
            // die();
        ?>
            <tr>
                <th scope="row"><form style="display: inline-block;" method="post" action="changeStatus.php">
        <input name="check" type="hidden" value="<?=$data?>">
        <input type="checkbox" <?php echo ($value['completed']==true)?"checked":"";  ?> style="display: inline-block;" name="checkbox">
        </form></th>
                <td><?= $data ?></td>
                <td><form action="delete.php" method="post" style="display: inline-block;">
            <input name="delete" type="hidden" value="<?=$data?>">
            <button>Delete</button>
        </form></td>

            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php
include_once('down.php');
?>
</body>
<script>
    const checkboxes=document.querySelectorAll('input[type=checkbox][name=checkbox]');
    checkboxes.forEach(element => {
        element.onclick=function(){
            this.parentNode.submit();
        }
    });
</script>
</html>
