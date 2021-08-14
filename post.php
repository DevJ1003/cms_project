<?php

include "includes/db.php";
include "includes/header.php";

/*Navigation */
include "includes/navigation.php";



/* POST LIKE UNLIKE FUNCTION */

if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];

    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
    $send_query = mysqli_query($connection, $view_query);

    if (!$send_query) {
        die("QUERY FAILED");
    }


    /* POST LIKE FUNCTION */
    if (isset($_POST['liked'])) {

        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];


        // 1 = FETCHING THE RIGHT POST
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $postResult = mysqli_query($connection, $query);
        $post = mysqli_fetch_array($postResult);
        $likes = $post['likes'];

        // 2 = UPDATE POST WITH LIKE
        mysqli_query($connection, "UPDATE posts SET likes = $likes + 1 WHERE post_id = $post_id");

        // 3 = CREATE LIKES FOR POSTS
        mysqli_query($connection, "INSERT INTO likes(user_id , post_id) VALUES ($user_id , $post_id)");
        exit();
    }


    /* POST UNLIKE FUNCTION */
    if (isset($_POST['unliked'])) {


        echo "unliked";

        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        // 1 = FETCHING THE RIGHT POST
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $postResult = mysqli_query($connection, $query);
        $post = mysqli_fetch_array($postResult);
        $likes = $post['likes'];


        // 2 = DELETE LIKES
        mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND post_id=$post_id");

        // 3 = UPDATE WITH DECREMENTED LIKES 
        mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");
        exit();
    }



    /* Blog Comments */

    if (isset($_POST['create_comment'])) {

        $_SESSION['user_id'];

        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

            $query = "INSERT INTO comments (comment_post_id , user_id , comment_author , comment_email ,
comment_content , comment_status , comment_date)";

            $query .= "VALUES ($the_post_id , '{$_SESSION['user_id']}' , '{$comment_author}' , '{$comment_email}' , '{$comment_content}' ,
'unapproved' , now() )";

            $create_comment_query = mysqli_query($connection, $query);

            if (!$create_comment_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        } else {

            echo "<script>alert('Fields cannot be empty!')</script>";
        }
    }


?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <?php

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                } else {

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'Published' ";
                }


                $select_all_posts = mysqli_query($connection, $query);

                if (mysqli_num_rows($select_all_posts) < 1) {

                    echo "<h1 class='text-center'>No posts available!</h1>";
                } else {

                    while ($row = mysqli_fetch_assoc($select_all_posts)) {

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    }


                ?>

                    <h1 class="page-header . text-center">
                        Post
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="/CMS/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="/CMS/author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="/CMS/images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <hr>


                    <?php

                    if (IsLoggedIn()) { ?>

                        <div class="row">
                            <p class="pull-right"><a style="font-size: 22px;" class="<?php echo userLikedThisPost($the_post_id) ? 'unlike' : 'like'; ?>" href=""><span class="glyphicon glyphicon-check" data-toggle="tooltip" data-placement="top" title="<?php echo userLikedThisPost($the_post_id) ? ' You liked the post before !' : ' You want to like the post ?'; ?>"></span><?php echo userLikedThisPost($the_post_id) ? ' Unlike' : ' Like'; ?></a>
                            </p>
                        </div>


                    <?php      } else {  ?>

                        <div class="row">
                            <p style="font-size: 22px;" class="pull-right">You need to <a href="/cms/login">login</a> to like the post !</p>
                        </div>

                    <?php } ?>


                    <div class="row">
                        <p class="pull-right" style="font-size: 22px;">Like: <?php getPostlikes($the_post_id); ?></p>
                    </div>

                    <div class="clearfix"></div>


                <?php } ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>


                <!-- Posted Comments -->

                <?php

                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'Approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if (!$select_comment_query) {

                    die('QUERY FAILED' . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_array($select_comment_query)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                ?>


                    <h2>Posted Comments :</h2>
                    <hr>

                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>

                    </div>


            <?php  }
            } else {
                header("Location: index.php");
            }

            ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

            <!-- Side Widget Well -->

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->

    <?php include "includes/footer.php" ?>

    <script>
        $(document).ready(function() {


            $("[data-toggle='tooltip']").tooltip();



            var post_id = <?php echo $the_post_id; ?>;
            var user_id = <?php echo logggedInUserId(); ?>;


            //LIKING FUNCTION

            $('.like').click(function() {

                $.ajax({

                    url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id,
                    }
                })
            });


            //UNLIKING FUNCTION

            $('.unlike').click(function() {

                $.ajax({

                    url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id,
                    }
                })
            });

        });
    </script>