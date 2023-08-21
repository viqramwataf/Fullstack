<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location:http://kenhosting.ddns.net/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Memes</title>

    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        var page = 1;

        function setPagination(pageinput) {
            page = pageinput;
        }
    </script>
    <?php
    echo "<script> var iduser = {$_SESSION['id']} </script>";
    ?>

</head>

<body>
    <button class="logout">Logout</button>
    <br>
    <div class="meme-container"></div>
    <br>
    <!-- <br> -->
    <div class="pagination"></div>
    

    <script>
        $(document).ready(function() {

            getResult(iduser, page);
            getPagination(page);
            $(".logout").click(function(e) {
                e.preventDefault();
                // alert("logged out clicked");
                getLogout();
            });
            $(document).on("click", ".like-container", function(e) {
                var idmeme = $(this).attr("id-meme");
                var liked = $(this).attr("like-status");
                addDeleteLike(iduser, idmeme, liked, page);
            });
        });

        function getPagination(page) {
            $.ajax({
                type: "POST",
                url: "http://kenhosting.ddns.net/ajax/pagination.php",
                data: {
                    "page": page
                },
                dataType: "html",
                success: function(response) {
                    // console.log(JSON.parse(response));
                    var response = parseInt(response);
                    var result = ``;
                    if (page - 1 > 0) {
                        result += `<a class="page-button" onclick="getResult(${iduser},${page-1})"><<</a>`;
                    }
                    for (let index = 1; index <= response; index++) {
                        var style = ``;
                        if (index == page){
                            style = `style="color:red;"`
                        }
                        result += `<a class="page-button" onclick="getResult(${iduser},${index})" ${style}>${index}</a>`;
                    }
                    if (page + 1 < response + 1) {
                        result += `<a class="page-button" onclick="getResult(${iduser},${page+1})">>></a>`;
                    }
                    // console.log(response + 1);
                    $(".pagination").html(result);
                }
            });
        }

        function getLogout() {
            $.ajax({
                type: "POST",
                url: "http://kenhosting.ddns.net/ajax/logoutajax.php",
                data: "data",
                dataType: "html",
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result['result'] === 'logged out') {
                        alert("Success logged out!");
                        location.href = "http://kenhosting.ddns.net/login.php";
                    }
                }
            });
        }

        function addDeleteLike(iduser, idmeme, liked, page) {
            if (liked == 'true') return;

            $.ajax({
                type: "POST",
                url: "http://kenhosting.ddns.net/ajax/addlike.php",
                data: {
                    "iduser": iduser,
                    "idmeme": idmeme,
                    "liked": liked,
                },
                dataType: "html",
                success: function(response) {
                    var result = JSON.parse(response);
                    // var result = JSON.parse(response)[0][0][0];

                    getResult(iduser, page);
                }
            });
        }

        function getResult(iduser, page) {
            // alert('iduser:'+iduser+', page:'+page);
            $.ajax({
                type: "POST",
                url: "http://kenhosting.ddns.net/ajax/memes.php",
                data: {
                    'iduser': iduser,
                    'page': page,
                },
                dataType: "html",
                success: function(response) {
                    const result_memes = JSON.parse(response)['data-memes'];
                    const result_likes = JSON.parse(response)['data-likes'];

                    var printed = ``;

                    result_memes.forEach(element => {
                        var like_img = `../Assets/image/blankHeart.png`;
                        var status_like = false;
                        for (let index = 0; index < result_likes.length; index++) {
                            if (element[0] == result_likes[index]) {
                                status_like = true;
                                break;
                            }
                        }
                        var disabled = '';
                        if (status_like) {
                            like_img = `../Assets/image/redHeart.png`;
                            disabled = 'disabled';
                        }
                        printed += `<div class="card">
                                    <img class="meme" src="${element[2]}" alt="jokeoveru">
                                        <div class="like-container" id-meme="${element[0]}" like-status="${status_like}">
                                            <img class="like-img like-${element[0]}" src="${like_img}" alt="like-${element[0]}" id-meme="${element[0]}" like-status="${status_like}">
                                            <p class="like-txt" id-meme="${element[0]}" like-status="${status_like}" >${element[1]} Likes</p>
                                        </div>
                                    </div>`;
                    });
                    $(".meme-container").html(printed);
                    setPagination(page)
                    getPagination(page);
                }
            });
        }
    </script>



</body>

</html>