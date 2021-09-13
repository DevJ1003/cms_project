<?php include "includes/admin_header.php";

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





function get_mydata_post()
{

    global $connection;

    $username = $_SESSION['username'];

    $query = "SELECT * FROM posts WHERE post_author = '{$username}' ";
    $query = mysqli_query($connection, $query);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {


        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_date = $row['post_date'];
        $post_views = $row['post_views_count'];


        $post_data = <<<DELIMETER

                    <tr>
                        <td>$post_id</td>
                        <td>{$post_author}</td>
                        <td>{$post_title}</td>
                        <td>{$post_image}</td>
                        <td>{$post_tags}</td>
                        <td>{$post_date}</td>
                        <td>
                            <a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a>
                        </td>
                        <td>{$post_views}</td>
                    </tr>
DELIMETER;
        echo $post_data;
    }
}






function get_mydata_comment()
{

    global $connection;

    $username = $_SESSION['username'];

    $query = "SELECT * FROM comments WHERE comment_author = '{$username}' ";
    $query = mysqli_query($connection, $query);
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {


        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];


        $post_data = <<<DELIMETER

                    <tr>
                        <td>$comment_id</td>
                        <td>{$comment_author}</td>
                        <td>{$comment_email}</td>
                        <td>{$comment_content}</td>
                        <td>{$comment_status}</td>
                        <td>{$comment_date}</td>
                    </tr>
DELIMETER;
        echo $post_data;
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
                    <h1 class="page-header"><i class="fa fa-fw fa-child"></i>
                        <?php welcomeLineIndex(); ?>
                        <small><?php echo get_user_name(); ?></small>
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
            </div>
            <!-- /.row -->





            <table class="table table-bordered">
                <h3 class="text-center"><i class="fa fa-fw fa-arrows-v"></i>Your Posts...!!</h3>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Post View Count</th>
                    </tr>
                </thead>
                <tbody>

                    <?php get_mydata_post(); ?>

                </tbody>

            </table>





            <table class="table table-bordered">
                <h3 class="text-center"><i class="fa fa-fw fa-file"></i>Your Comments...!!</h3>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                    <?php get_mydata_comment(); ?>

                </tbody>

            </table>



























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


                <!-- <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div> -->


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>