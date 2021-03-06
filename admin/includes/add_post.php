<?php

if (escape(isset($_POST['create_post']))) {

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    /* FORM DATA */
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_SESSION['username'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");



    $query = "INSERT INTO posts( post_title , post_category_id , post_author , post_status , post_image , post_tags , post_content , post_date) ";

    $query .= "VALUES( '{$post_title}' , '{$post_category_id}' , '{$post_author}' , '{$post_status}' , '{$post_image}' , '{$post_tags}' , '{$post_content}' , '{$post_date}' )";

    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created! <a href='../post.php?p_id={$the_post_id}'>View Post</a> Or <a href='posts.php'>Edit More Posts</a></p>";
}


?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="from-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div><br>


    <label for="categories">Categories</label>
    <select name="post_category" id="post_category">
        <?php

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        confirm($select_categories);

        while ($row = mysqli_fetch_assoc($select_categories)) {

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];


            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
        ?>
    </select>
    </div>

    </div>
    <div class="from-group">
        <select name="post_status" id="">
            <option value="Draft">Post Status</option>
            <option value="Published">Pulished</option>
            <option value="Draft">Draft</option>
        </select>
    </div><br>

    <div class="from-group">
        <label for="post image">Post Image</label>
        <input type="file" name="image">
    </div><br>

    <div class="from-group">
        <label for="post tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div><br>

    <div class="from-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
</textarea>
    </div><br>

    <div class="from-group">
        <input class="btn btn-primary" type="submit" name="create post" value="Publish Post">
    </div>

</form>