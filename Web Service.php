<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "northwind";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",
							$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, 
						PDO::ERRMODE_EXCEPTION);	 
}catch(PDOException $e){
	echo "Connection failed : ".$e->getMessage();
}
$sql = "SELECT * FROM customers AS p JOIN categories
 AS c ON p.CustomerID=c.CustomerID";
$data= $conn->prepare($sql);
$data->execute();
$customers = [];
while($row = $data->fetch(PDO::FETCH_OBJ)){
	$customers[] = ["CustomerID"=>$row->CustomerID,
				   "CompanyName"=>$row->CompanyName,
				   "ContactName"=>$row->ContactName,
				   "ContactTitle"=>$row->ContactTitle,
				   "Address"=>$row->Address,
				   "City"=>$row->City,
				   "Region"=>$row->Region,
				   "PostalCode"=>$row->PostalCode,
				   "Country"=>$row->Country,
				   "Phone"=>$row->Phone,
				   "Fax"=>$row->Fax];
}
$abc=json_encode($customers);
print_r($abc);
 
?>