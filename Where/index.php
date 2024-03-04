<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Where Clause</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: cursive;
        }
        header{
            height: 55vh;
            width: 100%;
            background-color: #f0f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            background-color: white;
            height: 300px;
            width: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
        }
        button{
            background-color: #99ebff;
            border-radius: 5px;
            border: none;
            font-size: 16px;   
            height: 40px;
            width: 150px;    
        }
        input{
            box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.2);
            border: none;
            height: 30px;
            border-radius: 5px;
            width: 320px;
            padding-left: 20px;
        }
        h1{
            color: #99ebff;
        }
        #span1{
            color: #00e673;
        }
        #span2{
            color: red;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        th {
            background-color: #99ebff;
        }
        td:hover{
            background-color: #99ebff;
        }
        #lbl{
            height: 100px;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <form method="post">
            <h1>PHP MySQL Use The WHERE Clause</h1><br>
            <div id="lbl">
                <label>Search for the name :  </label>
                <input type="text" name="fname" placeholder="Search the name"><br><br>
            </div>
            <br>
            <button type="submit" name="submit">Select</button>
        </form>
    </header>

    <?php
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit"])){
        $fname = validate($_POST['fname']);
        try{
            $conn = new PDO("mysql:host=localhost;dbname=ana","root","" );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM Form WHERE FirstName LIKE '%$fname%'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            echo "<table>";
            echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th></tr>";
            foreach($result as $row){
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['FirstName']}</td>
                    <td>{$row['LastName']}</td>
                    <td>{$row['Email']}</td>
                </tr>";
            }
            echo "</table>";
        } catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
        }
    }
    $conn = null;
    ?>
</body>
</html>
