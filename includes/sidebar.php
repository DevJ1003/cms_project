<?php

if (IfItIsMethod('post')) {

    if (isset($_POST['username']) && isset($_POST['password'])) {

        login_user($_POST['username'], $_POST['password']);
    } else {

        redirect('CMS');
    }
}

?>


<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form><!-- search form-->
        <!-- /.input-group -->
    </div>


    <!-- Blog Categories Well -->
    <div class="well">


        <?php

        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($connection, $query);  ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">



                <?php

                while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {

                    $cat_title = $row['cat_title'];
                    $cat_id    = $row['cat_id'];

                    echo    "<li>
                    <a href='/CMS/category/$cat_id'>{$cat_title}</a>
                    </li>";
                }

                ?>


            </div>
            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->


        <!-- Side Widget Well -->

    </div>

    <?php include "widget.php" ?>

</div>