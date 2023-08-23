<?php
//
//物件管理リスト
//
function fnSqlArticleList($flg, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo)
{
	switch ($flg) {
		case 0:
			$sql  = "SELECT COUNT(*)";
			break;
		case 1:
			$sql  = "SELECT ARTICLENO, ARTICLE, ROOM, KEYPLACE, ARTICLENOTE, KEYBOX, DRAWING, SELLCHARGE";
			break;
	}
	$sql .= " FROM TBLARTICLE";
	$sql .= " WHERE DEL = $sDel";
	if ($sArticle) {
		$sql .= " AND ARTICLE LIKE '%$sArticle%'"; //''の中の変数のスペルが間違っているのと「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sRoom) {
		$sql .= " AND ROOM LIKE '%$sRoom%'"; //「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sKeyPlace) {
		$sql .= " AND KEYPLACE LIKE '%$sKeyPlace%'"; //「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sArticleNote) {
		$sql .= " AND ARTICLENOTE LIKE '%$sArticleNote%'"; //「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sKeyBox) {
		$sql .= " AND KEYBOX LIKE '%$sKeyBox%'"; //''の中の変数のスペルが間違っているのと「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sDrawing) {
		$sql .= " AND DRAWING LIKE '%$sDrawing%'"; //「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($sSellCharge) {
		$sql .= " AND SELLCHARGE LIKE '%$sSellCharge%'"; //「OR」でコーディングしたため検索機能が正常に動作しなかったので「AND」に修正
	}
	if ($orderBy) {
		$sql .= " ORDER BY $orderBy $orderTo";
	}
	if ($flg) {
		$sql .= " LIMIT " . (($sPage - 1) * PAGE_MAX) . ", " . PAGE_MAX; //記号が間違っていて($sPage + 1)ページが200から表示されるようになっていたので修正
	}

	return ($sql);
}



//
//物件管理情報
//
function fnSqlArticleEdit($articleNo)
{
	$sql  = "SELECT ARTICLE, ROOM, KEYPLACE, ADDRESS, ARTICLENOTE, KEYBOX, DRAWING, SELLCHARGE, DEL";
	$sql .= " FROM TBLARTICLE";
	$sql .= " WHERE ARTICLENO = $articleNo"; //ARTICLENO = 1になっていてそのデータしか表示できないようになっていたため修正

	return ($sql);
}



//
//物件管理情報更新
//
function fnSqlArticleUpdate($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del)
{
	$sql  = "UPDATE TBLARTICLE";
	$sql .= " SET ARTICLE = '$article'";
	$sql .= ",ROOM = '$room'";
	$sql .= ",KEYPLACE = '$keyPlace'";
	$sql .= ",ADDRESS = '$address'"; //",ADDRESS = '$address"のシングルコーテーションが抜けていたため修正
	$sql .= ",ARTICLENOTE = '$articleNote'";
	$sql .= ",KEYBOX = '$keyBox'";
	$sql .= ",DRAWING = '$drawing'";
	$sql .= ",SELLCHARGE = '$sellCharge'";
	$sql .= ",DEL = '$del'";
	$sql .= " WHERE ARTICLENO = $articleNo";

	return ($sql);
}



//
//物件管理情報登録
//
function fnSqlArticleInsert($articleNo,  $keyPlace, $article, $address,  $keyBox, $articleNote, $drawing, $sellCharge, $room, $del)
{
	$sql  = "INSERT INTO TBLARTICLE ("; //テーブル名が小文字だったので正しく動作しなかったため修正
	$sql .= " ARTICLENO, ARTICLE, ROOM, KEYPLACE, ADDRESS, ARTICLENOTE, KEYBOX, DUEDT, SELLCHARGE, AREA, YEARS, SELLPRICE, INTERIORPRICE, CONSTTRADER," //カラム名の順番がずれていたので正しく登録されなかったため修正
		. " CONSTPRICE, CONSTADD, CONSTNOTE, PURCHASEDT, WORKSTARTDT, WORKENDDT, LINEOPENDT, LINECLOSEDT, RECEIVE, HOTWATER, SITEDT, LEAVINGFORM," //同上
		. " LEAVINGDT, MANAGECOMPANY, FLOORPLAN, FORMEROWNER, BROKERCHARGE, BROKERCONTACT, INTERIORCHARGE, CONSTFLG1, CONSTFLG2, CONSTFLG3, CONSTFLG4, INSDT, UPDT, DEL,"
		. " DRAWING, LINEOPENCONTACTDT, LINECLOSECONTACTDT, LINECONTACTNOTE, ELECTRICITYCHARGE, GASCHARGE, LIGHTORDER";
	$sql .= " ) VALUES ( ";
	$sql .= "'$articleNo', '$article', '$room', '$keyPlace', '$address', '$articleNote', '$keyBox', '', '$sellCharge', '', '', '', '', '',"
		. " '', '', '', '', '', '', '', '', '', '', '', '',"
		. " '', '', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$del',"
		. " '$drawing', '', '', '', '', '', '' )";

	return ($sql);
}



//
//物件管理情報削除
//
function fnSqlArticleDelete($articleNo)
{
	$sql  = "UPDATE TBLARTICLE";
	$sql .= " SET DEL = 0";
	$sql .= ",UPDT = CURRENT_TIMESTAMP";
	$sql .= " WHERE ARTICLENO = '$articleNo'";

	return ($sql);
}
