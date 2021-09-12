<?php include "includes/admin_header.php";


?>


<?php


// $post_count = countRecords(get_all_user_posts());
// $category_count = recordCount('categories', $_SESSION['user_id']);
// $category_count = countRecords(get_all_user_category());
// $post_published_count = countRecords((get_all_user_published_posts()));
// $draft_post_count = countRecords(get_all_user_draft_posts());
// $unapproved_comment_count = checkStatus('comments', 'comment_status', 'unapproved', $_SESSION['user_id']);
// $approved_comment_count = checkStatus('comments', 'comment_status', 'approved', $_SESSION['user_id']);

function count_comments_user()
{


    if (IsLoggedIn()) {

        $username = $_SESSION['username'];


        $query = query("SELECT comment_id FROM comments WHERE comment_author = '{$username}' ");
        confirm($query);

        $comments_count = mysqli_num_rows($query);

        echo $comments_count;
    }
}






function count_posts_user()
{


    if (IsLoggedIn()) {

        $username = $_SESSION['username'];


        $query = query("SELECT post_id FROM posts WHERE post_author = '{$username}' ");
        confirm($query);

        $posts_count = mysqli_num_rows($query);

        echo $posts_count;
    }
}












?>


<div id="wrapper">


    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php
                        welcomeLineIndex()
                        ?>
                        <small><?php echo strtoupper(get_user_name());
                                ?></small>
                    </h1>

                </div>
            </div>



            <!-- /.row -->




            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php count_posts_user(); ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php count_comments_user(); ?></div>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <!-- <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php //echo "<div class='huge'>" . $category_count . "</div>" 
                                    ?>

                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> -->

            </div>
            <!-- /.row -->


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([


                            ['Data', 'Count'],

                            <?php

                            $element_text = [
                                'All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Approved Comments', 'Unapproved Comments', 'Categories'
                            ];


                            $element_count = [
                                $post_count, $post_published_count, $draft_post_count,  $comment_count, $approved_comment_count, $unapproved_comment_count, $category_count
                            ];




                            for ($i = 0; $i < count($element_count); $i++) {
                                // echo $element_count[$i];
                                echo "['{$element_text[$i]}' , ", " {$element_count[$i]}],";
                            }


                            ?>

                            //            ['2014', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>


                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php" ?>