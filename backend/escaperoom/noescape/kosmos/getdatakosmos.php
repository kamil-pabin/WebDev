<!-- Skrypt służacy do pobierania danych z bazy danych i wyświetlania ich, tj. zdjęcia i podpowiedzi tekstowej  -->
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald:300|ZCOOL+XiaoWei" rel="stylesheet">
    <style>
    #txt{
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 10px;
            padding-bottom: 10px;
            
        }
    </style>
</head>

<body>
    <?php
        $q = intval($_GET['q']);
        $con = mysqli_connect('localhost','root','','noescape');

        if (!$con) 
        {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con,"noescape");
        $sql="SELECT * FROM kosmos WHERE kosmos.ID = '".$q."' ";       
        $result = mysqli_query($con,$sql);
        echo "<br>";

        $fontsize = "4.5vw";
        
        
        while($row = mysqli_fetch_array($result)) 
        {
            $dlugosc = strlen($row['Nazwa']);
            if ($dlugosc < 20){
                $fontsize = "9vw";
            }
            else if ($dlugosc >= 20 AND $dlugosc < 60){
                $fontsize = "6vw";
            }
            else if ($dlugosc >= 60 AND $dlugosc < 150){
                $fontsize = "4vw";
            }
            else if ($dlugosc >= 150 AND $dlugosc < 220){
                $fontsize = "3.5vw";
            }
            else if ($dlugosc >= 220){
                $fontsize = "2.5vw";
            }
            echo "<img src='" .$row['Zdjecie']."' style='width: 1280; max-height:600'  >" . "</br>";  
            echo "<div id='txt' style='font-size: $fontsize; word-wrap: break-word;' > <b>".$row['Nazwa']. "</b> </div>";         
        }
        echo "</br>";
        
        mysqli_close($con);
    ?>
</body>

</html>