<?php
// 修改公告內容

	function drawBulletinModify()
	{
		$css = "";
		$js = "";
		$html = "";
		$result = "";


		$css 	= "<style>"
			. ""
			. "</style>";

		$js	= ""
			. "";

		$bulletin_data = getData();

		$html	= "<div class=\"gen-title\">公告管理</div>"
			. "<hr class=\"gen-hr\">"
			. "<div class=\"gen-wrapper\">"
			. 	"<table class=\"gen-table\">"
			.		"<tr><td width=\"150\">日期</td><td width=\"400\">標題</td><td width=\"150\">發佈者</td><td width=\"50\">修改</td><td width=\"50\">刪除</td></tr>"
			.		$bulletin_data
			. 	"</table>"
			. "</div>";


		$result = array("css"=>$css, "js"=>$js, "html"=>$html);
		$result = json_encode($result);

		return $result;
	}



?>

<?php
	function getData()
	{
		$result = "";

		include 'connectDB.php';
		$connect = connect_to_DB();

		if ($connect != null) {
			$sql = "SELECT * FROM bulletin ORDER BY time DESC";
			
			$query_result = mysqli_query($connect, $sql);
			while ($row = mysqli_fetch_array($query_result)) {
				$id = $row['id'];
				$time = $row['time'];
				//$unit = $row['unit'];
				$author = $row['author'];
				$title = $row['title'];
				
			$result .= "<tr><td width='150'>$time</td><td width='400'>$title</td><td width='150'>$author</td><td width='50'><button>修改</button></td><td width='50'><button>刪除</button></td></tr>";
			}
		} else {
			$result = "<div>Can not connect to DB.  ERROR!</div>";
		}

		mysql_close($connect);
		return $result;
	}
?>
