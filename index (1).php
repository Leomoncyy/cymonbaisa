<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
*{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background: #e9e9e7;
}
h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: black;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4268b3;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #4268b3;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}
 .button { 
  -webkit-appearance: none;
  font-weight: normal;
  background-image: none;
  border: 1px solid transparent;
  font-size: 14px;
  border-radius: 12px;
  color: #fff;
  background: #4268b3;
  letter-spacing: 0.08em;
  margin-left: 70px;

  &.-primary {
    
    padding:8px;
    background: $button-color;
  }
  
}
  </style>
</head>
<body>
  <h2>Transactions Table</h2>
  <a href="https://cymonbaisa.000webhostapp.com/checkout.php"><input style="cursor:pointer" class="button -primary" type="submit" name="submit" value="Proceed to checkout"></input></a><br>
<br><div class="table-wrapper">
    
    <table class="fl-table">
        <?php
        $sql = "SELECT * FROM tbl_transactions ORDER BY ID DESC";
        $resSql = mysqli_query($conn,$sql);
        if(mysqli_num_rows($resSql) > 0){
            ?>
            <thead>
            <tr>
                <th>ID</th>
                <th>TXNID</th>
                <th>REFERENCE NO</th>
                <th>CURRENCY</th>
                <th>DESCRIPTION</th>
                <th>EMAIL</th>
                <th>PROCID</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>MESSAGE</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($rowData = mysqli_fetch_array($resSql)){
                ?>
                <tr>
                <td><?php echo $rowData['ID']; ?></td>
                <td><?php echo $rowData['txnid']; ?></td>
                <td><?php echo $rowData['refno']; ?></td>
                <td><?php echo $rowData['ccy']; ?></td>
                <td><?php echo $rowData['description']; ?></td>
                <td><?php echo $rowData['email']; ?></td>
                <td><?php echo $rowData['procid']; ?></td>
                <td><?php echo $rowData['amount']; ?></td>
                <?php
                if($rowData['status'] == "Success"){
                    $color = "style='background: #03C03C'";
                }elseif($rowData['status'] == "Pending"){
                    $color = "style='background: #FFA500'";
                }elseif($rowData['status'] == "Failure"){
                    $color = "style='background: #DC143C'";
                }else{
                    $color = "";
                }
                ?>
                <td <?php echo $color; ?>><?php echo $rowData['status']; ?></td>
                <td><?php echo $rowData['message']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <tbody>
    </table>
</div>
</body>
</html>