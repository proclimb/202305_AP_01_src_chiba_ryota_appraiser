//
//物件管理チェック
//
function fnArticleEditCheck() {
	tmp = form.article.value;
	if (tmp == '') { //入力チェックが正常に行えるよう修正
		alert('物件名を入力してください');
		return;
	}
	if (isLength(100, "物件名", form.article)) { return; } //入力チェックが正常に行えるよう追加
	if (isLength(100, "部屋番号", form.room)) { return; } //同上
	if (isLength(200, "鍵場所", form.keyPlace)) { return; } //同上
	if (isLength(100, "住所", form.address)) { return; } //同上
	if (isLength(200, "備考", form.articleNote)) { return; } //同上
	if (isLength(100, "キーBox番号", form.keyBox)) { return; } //同上
	if (isLength(100, "3Dパース", form.drawing)) { return; } //同上
	if (isLength(100, "営業担当者", form.sellCharge)) { return; } //同上

	if (confirm('この内容で登録します。よろしいですか？')) { //ポップアップが表示されるよう修正
		form.act.value = 'articleEditComplete';
		form.submit();
	}
}



function fnArticleDeleteCheck(no) {
	if (confirm('削除します。よろしいですか？')) {
		form.articleNo.value = no;
		form.act.value = 'articleDelete';
		form.submit();
	}
}
