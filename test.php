<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php

echo logggedInUserId();

if (userLikedThisPost(1)) {

    echo "USER LIKED IT";
} else {
    echo "USER DID NOT LIKE IT";
}

?>