<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //path to di
    $dirPath = 'files/images/';
    //file var
    $file = $_FILES["file"]["name"];
    //make dir if not exists
    if (!file_exists($dirPath)) {
        mkdir($dirPath, 0777, true);
    }
    //check if file uploaded before
    if (file_exists($dirPath . $file)) {
        //reject file
        echo $file . " already exists. ";
    } else {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $parsedFile = explode(".", $file);
        $extension = end($parsedFile);
        //
        print_r($parsedFile);
        echo '<hr>' . $_FILES["file"]["type"] . '<hr>';
        //
        if (
            ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/png")
        ) {
            echo '<hr>' . $file . ' is of correct type: ' . $_FILES["file"]["type"] . ' <hr>';
            //check if image is less than 1mb
            if ($_FILES["file"]["size"] < 1000000) {
                echo '<hr>' . $_FILES["file"]["size"] . ' is below 20mb<hr>';
                if (in_array($extension, $allowedExts)) {
                    echo 'in array';
                    //store
                    move_uploaded_file($_FILES["file"]["tmp_name"], $dirPath . $file);
                    echo "Stored in: " . $dirPath . $file;
                    echo '<img src=' . $dirPath . $file . '>';
                } else {
                    echo 'not in array!! REJECTED';
                }
            } else {
                echo '<hr>' . $_FILES["file"]["size"] . ' is ABOVE 1mb!! REJECTED<hr>';
            }
        }
    }
}

//     if ((($_FILES["file"]["type"] == "image/gif")
//         || ($_FILES["file"]["type"] == "image/jpeg")
//         || ($_FILES["file"]["type"] == "image/jpg")
//         || ($_FILES["file"]["type"] == "image/png"))
//         && ($_FILES["file"]["size"] < 20000)
//         && in_array($extension, $allowedExts)) {
//         move_uploaded_file($_FILES["file"]["tmp_name"], $dirPath . $file);
//         echo "Stored in: " . $dirPath . $file;
//     } else {
//         echo "Failed!Not Stored in: " . $dirPath . $file;
//     }
// }
//}
