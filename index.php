<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="navbar">

            <h3>Vending Machine</h3>
        </div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "vendingmachine";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>
        <form action="" method="post">
            <select name="select" id="select" onchange="this.form.submit()">
                <?php
                $qry = $conn->query("SELECT * FROM ms_item");
                while ($data = $qry->fetch_assoc()) { ?>
                    <option id="kode" value="<?= $data['id']; ?>" <?php
                                                                    if ($_POST['select'] == $data['id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>
                        <?= $data['descp']; ?></option>
                <?php } ?>
            </select>

            <p>
                <?php
                if (isset($_POST['select'])) {
                    $qry = $conn->query("SELECT * FROM ms_item WHERE id='$_POST[select]'");
                    $res = $qry->fetch_assoc(); ?>
                    <br>
                    <input id="price" class="number" value="<?= $res['price']; ?>" readonly></input>
                    <br>
                    <input id="stock" class="number" value="<?= $res['stock']; ?>" readonly></input>
                    <br>
                    <input id="jum" class="number" placeholder="qty"></input>
                    <br>
                    <input id="jumrp" class="number" value="" placeholder="Total"></input>

                <?php } ?>
            </p>
            <button id="buy" type="button" value="Total Bayar" class="btn btn-sm btn-outline-primary">Buy</button>
        </form>

</body>
<script>
    document.getElementById("buy").onclick = function() {
        // alert('onclick');
        let beli = document.getElementById("price").value;
        let qty = document.getElementById("jum").value;
        let qrp = document.getElementById("stock").value;
        let result = beli * qty;
        document.getElementById("jumrp").value = result;
        let kode = document.getElementById("kode").value;
        if (qty > qrp) {
            alert("stock sedikit");
            document.getElementById("jumrp").value = 0;
        } else if (qty == "") {
            alert("data null");
        } else {
            alert(result);
        }
    };
</script>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</html>