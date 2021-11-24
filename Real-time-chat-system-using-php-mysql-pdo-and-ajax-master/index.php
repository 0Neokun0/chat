<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>chat app</title>
        <link rel="stylesheet" href="resources/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script type="text/javascript" src="resources/jquery.js"></script>
    </head>
    <body>
<?php
session_start();
$_SESSION['username'] = "Nishant Meher";
//echo var_dump($_SESSION);
?>
        <div id="wrapper">
            <h1 class="h3 mb-3" >Welcome
                <?php
                //session_start();
                echo $_SESSION['username'];
                ?>
                to my chat app</h1>
            <div class="col-12 col-lg-7 col-xl-9">
                <div id="chat"></div>
                <form class="" id="msgform" action="index.php" method="post">
                    <textarea name="message" rows="8" cols="80" class="textarea"></textarea>
                </form>
            </div>
        </div>

<script type="text/javascript">
    LoadChat();
    setInterval(function () {
        LoadChat();
    }, 1000);
    function LoadChat() {
        $.post('handlers/messages.php?action=getMessages', function (response) {

            var scrollpos = $('#chat').scrollTop();
            var scrollpos = parseInt(scrollpos) + 420;
            var scrollHeight = $('#chat').prop('scrollHeight');

            $('#chat').html(response);
            if (scrollpos < scrollHeight){

            } else{
                $('#chat').scrollTop($('#chat').prop('scrollHeight'));
            }

        })
    }
    $('.textarea').keyup(function(e){
            //alert(e.which);
        if (e.which == 13){
            //alert('enter is pressed')
            $('form').submit();
        }
        });
    $('form').submit(function () {
        //alert('form is submit jquery');
        var message = $('.textarea').val();
        $.post('handlers/messages.php?action=sendMessage&message='+message, function (response) {
            //alert(response);
            if (response==1){
                LoadChat();
                document.getElementById('msgform').reset();
            }
        });
        return false;
    })
</script>

    </body>
</html>
