<?php
	require_once "../../config/db.koneksi_pdo.php";
	require_once "../../config/db.function_pdo.php"; 
	require_once "../../config/library.php";
	
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : "";
	$urut = isset($_GET['urut']) ? $_GET['urut'] : "";
	$limit = isset($_GET['limit']) ? $_GET['limit'] : "";
	$filter = "";
	if($id_user != ""){
		$filter .= " AND id_user = '$id_user' ";
	} else {
		$filter .= " ";
	} 

	$clause = " SELECT
					* 
				FROM 
					tb_user WHERE id_user IS NOT NULL $filter";
	$result = array();

	$rs = $DBcon->prepare($clause);
	$rs->execute();
	$r= $rs->rowCount();
	$items = array();
	$no=1;
	while($row = $rs->fetch(PDO::FETCH_ASSOC)){
		$row['no'] = $no;
		$row["aksi"] = '
		<span onClick="deleteData('."'".$row["id_user"]."'".')" style="cursor:pointer" class="btndel tip" data-toggle="tooltip" title="Hapus">&nbsp;<i class="fa fa-trash"></i>&nbsp;</span>
		&nbsp;
		<span onClick="editData('."'".$row["id_user"]."'".')" style="cursor:pointer" class="btnedit tip" data-toggle="tooltip" title="Edit">&nbsp;<i class="fa fa-pen"></i>&nbsp;</span>';
		
		$row['hak_akses'] = $row['group_user'];
		
		if($row['group_user']==100){ 
			$row['group_user'] = "Admin";
		}elseif ($row['group_user']==101){ 
			$row['group_user'] = "Operator";
		}elseif ($row['group_user']==1000){ 
			$row['group_user'] = "Stakeholder";
		}	
		
	
		$no++;
		array_push($items, $row);
	}
	$result['result'] = $items;

	echo json_encode($result);
?>
