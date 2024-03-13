<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorySphere - Start writing...</title>
    <link rel="shortcut icon" href="images/ssLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="write.css">
    <style>
        body {
            background-image: url(images/bg7.jpg);
            background-size: cover;
        }
        #description {
            height: 500px;
        }

        #title{
            margin-left: 69px;
        }
        .container {
            margin-top: 30px;
            border-radius: 20px;
            padding: 16px;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .buttom .next{
            margin-left: 150px;
        }
    </style>
</head>

<body>

    <center>
        <div class="container">
            <form action="">
                <div class="loginHead">
                    <a href="index.php"><img src="images/ssLogo.jpg" alt="logo" height="50px"></a>
                    <h1>Start Writing</h1>
                </div>

                <label for="title">Title:
                    <input type="text" id="title" name="story-title" class="form-control" placeholder="E.g.: Episode 1: The sunrise" required></label><br>

                <label for="description">Add your Text: <textarea id="description" name="description" required
                        class="form-control"></textarea></label>
                

                <p><i>Note: you can publish only one chapter or title at a time and it should be completed. <br> For publishing next chapter of the story you have to click on edit button after publishing this one. </i></p>


                <br>
                <div class="buttom">
                <a href="read.php"><button class="cancel">Cancel</button></a>
                <a href="next.php"><button class="next" name="next">Next</button></a>
            </form>
        </div>
    </center>
</body>

</html>