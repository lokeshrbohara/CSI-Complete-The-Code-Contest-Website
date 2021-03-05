<?php
include_once "config.php";

session_start();
$msg='';
if(!isset($_SESSION["email"]))
{
    header("Location:index.php");
    exit();
}
$email=$_SESSION['email'];
$sql = $con->query("SELECT * FROM contest WHERE email='$email'");
$data = $sql->fetch_array();
$q="";
$t=1;
for($i=1;$i<=8;$i++)
{
    if(is_null($data["timeq".$i]))
    {
        $q="q".$i;
        //var_dump($q);
        break;
    }
}
if(!is_null($data['timeq8']))
{
    
    header('Location: logout.php');
  
}

if(isset($_SESSION['email']))
{
    if(isset($_POST["submit"]))
    {
        $ans=$_POST["ans"];
        $con->query("UPDATE contest set ".$q."='$ans' , time".$q."= now() where email='$email'");
        header('Location: contest.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="predictor.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Contest</title>
</head>
<body>
    




    
<div class="container-login100" style="background-image: url('images/background.jpg');">
	<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="width:80%;">

            <p> Welcome <?php echo $data['name'] ?></p>
			<div  class="PKhmud tzVsfd F9PbJd IJRrpb" style="width:-webkit-fill-available;">
                            
                <p>
                    <?php 
                    $sql1 = $con->query("SELECT * FROM questions WHERE qid='$q'");
                    $data1 = $sql1->fetch_array();
                    echo $data1["question"]; ?>
                </p>
                <div  class="PKhmud tzVsfd F9PbJd IJRrpb" style="width:-webkit-fill-available;">
                <form method="post" enctype="multipart/form-data" action="contest.php">

                    <textarea name="ans" style="border: none; margin-top: 0px; margin-bottom: 0px; height: 350px; width: -webkit-fill-available;" placeholder="Type Your Code Here!"></textarea><br>
                    <button type="submit" name="submit" class="btn btn-fill btn-primary">Submit</button>

                </form>
                </div>

            </div>
			
        

	</div>
</div>

</body>
</html>
