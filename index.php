<style>
    body {
        margin: 0;
    }

    #title_inner {
        color: #111111;
        padding: 12px;
        margin: 12px;
        display: inline-block;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 35px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    #title_outer {
        width: 100%;
        height: 12%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #inner_inner {
        color: #fff;
        padding: 12px;
        display: inline-block;
        text-align: center;
        font-size: 22px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    #inner {
        color: #fff;
        background: #2d2d2d;
        border: #fff 5px solid;
        box-shadow: #2d2d2d 0px 0px 30px -10px;
        border-radius: 15px;
        padding: 12px;
        margin: 12px;
        display: inline-block;
        min-height: 50px;
        min-width: 200px;
        max-width: 40%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #outer {
        width: 100%;
        height: 88%;
        background: #009999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div id="title_outer">
    <div id="title_inner">
        Quotes-PHP - A small hands-on-workshop
    </div>
</div>

<div id="outer">
    <div id="inner">
        <div id="inner_inner">
            <?php
                $link = new mysqli($_ENV["MYSQL_SERVICE_HOST"],"user1","mypa55","quotes", $_ENV["MYSQL_SERVICE_PORT"]);
            ?>
            
            <?php
                // Check connection
                if ($mysqli -> connect_errno) {
                  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                  exit();
                }
            
                if (isset($_POST["quote"])) {
                    $query = "insert into quote (msg) values ('". $_POST["quote"] ."');";
                    $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
                    $row = mysqli_fetch_array($result);
                    mysqli_free_result($result);
                }

                $query = "SELECT count(*) FROM quote";
                $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
                $row = mysqli_fetch_array($result);
                mysqli_free_result($result);

                $id = rand(1,$row[0]);

                $query = "SELECT msg FROM quote WHERE id = " . $id;
                $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
                $row = mysqli_fetch_array($result);
                mysqli_free_result($result);

                print $row[0] . "\n";
            ?>
            
            <?php
                mysqli_close($link);
            ?>
        </div>
    </div>
    <form action="index.php" method="post">
    Quote: <input type="text" name="quote"><br>
    <input type="submit">
    </form>
</div>


