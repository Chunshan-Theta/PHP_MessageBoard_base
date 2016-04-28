<?PHP
	require('config.php');
	$title=isset($_POST['title'])?$_POST['title']:null;
	$auther=isset($_POST['auther'])?$_POST['auther']:null;
	$content=isset($_POST['content'])?$_POST['content']:null;
	$id=isset($_GET['id'])?$_GET['id']:null;
	$act=isset($_GET['act'])?$_GET['act']:null;
	$num=1;
	switch($act){
		case 'insert':
		/*
			*新增事件
			*觸發事件後，首先先設一個自訂變數(data)以陣列方式去接收數值(title,content,auther)
			*再次設定一個新的自訂變數(query)去準備路徑和功能(INSERT)
			*INSERT INTO test(test欄位)VALUE (數據)
			*準備完後就以execute關鍵字去執行，便完成新增事件
			*最後用header('Location:首頁網址');回到首頁(text.php)
		*/
			$data = array(':title' => $title,
						':content' => $content,
						':auther' => $auther,);
			$query = $_link->prepare('INSERT INTO test(title,auther,content,posttime)VALUE (:title,:auther,:content,CURRENT_TIMESTAMP)');
			$query->execute($data);
			header('Location:text.php');
		break;
		case 'del':
		/*
			*刪除事件
			*WHERE 表示條件
		*/
			$data = array(':id' => $id);
			$del = $_link->prepare('DELETE FROM test WHERE id=:id');
			$del->execute($data);	
			header('Location:text.php');			
			
		break;
		case 'upd':
		/*
			*更新事件_1
			*第一步：透過id，用"SELECT"來選擇事件 
			*第二步：讀取選擇的事件(fetch(PDO::FETCH_OBJ);)
		*/
			$data = array(':id' => $id);
			$query = $_link->prepare('SELECT * FROM test WHERE id=:id');
			$query->execute($data);
			$result_upd = $query->fetch(PDO::FETCH_OBJ);
			
			//var_dump($result_upd);					
			break;
		case 'do_upd':
		/*
			*更新事件_2
			*第三步：以id指定位置後，用"update"關鍵字來做更新
			*最後回到主頁面
		*/
			$data = array(':id' => $id,
						':title' => $title,
						':auther' => $auther,
						':content' => $content);
			$query = $_link->prepare('UPDATE test SET title=:title,auther=:auther,content=:content WHERE id=:id');
			$query->execute($data);			
			header('Location:text.php');
			break;
		default:
		/*
			*顯示全部留言紀錄
			*當act沒有數值時觸發
			*首先先設一個自訂變數(view)以陣列方式去準備路徑和功能(SELECT)
			*再次設定一個新的自訂變數(query)去準備路徑和功能↓
			*$view = $_link->prepare('SELECT * FROM test'); 
			*!!! * 是全部的意思 !!!			
		*/
			$view = $_link->prepare('SELECT * FROM test');
			$view->execute();
			$result = $view->fetchAll(PDO::FETCH_OBJ);
		
	}

?>
<html>
	<head>
	<meta charset='utf-8'/>
	</head>
	<body>
		<?php if($act=='upd'):?><!--更新頁面-->	
			<form method='POST' action='text.php?act=do_upd&id=<?php echo $id; ?>'>
				<label for='title'>標題：</label><input type='text' name='title' id='title' placeholder='<?php echo $result_upd->title; ?>'/></br>
				<label for='auther'>作者：</label><input type='text' name='auther' id='auther' placeholder='<?php echo $result_upd->auther;?>'/></br>
				<label for='content'>內容：</label><textarea type='text' name='content' id='content' placeholder='<?php echo $result_upd->content; ?>'></textarea></br>
				<input type='submit' value='送出' name='upd'/><hr>					
			</form>		
		<?php elseif($act!='do_upd'):?>
			<form method='POST' action='text.php?act=insert'>  
			<!--
				*點擊下方送出後傳至(action='text.php?act=insert)這個畫面
				*因為act被賦予"insert"數據，所以觸發switch(act)中的 case'insert':
			-->		
				標題<input type='test' name='title' id='title'/></br>
				作者<input type='test' name='auther' id='auther'/></br>
				內容<br><textarea type ='text' name='content' id='content'></textarea></br>		
				<input type='submit' value='送出' name='insert'/>
			</form>
			
			<article>
			<?php foreach($result as $v):?>
				
				======================================================================================
				<h1><?php echo $num; ?>.<?php echo $v->title; ?></h1>
				<p>內文：<br><?php echo $v->content; ?></p>
				<p><?php echo $v->auther; ?>     於<?php echo $v->posttime;?>發文</p>
				
				<input type='button' value='刪除' name='del' id='del' onclick="location.href='text.php?act=del&id=<?php echo $v->id; ?>'"/>
				<input type='button' value='修改' name='upd' id='upd' onclick="location.href='text.php?act=upd&id=<?php echo $v->id; ?>'"/><br>
				<?php $num++; ?>
			<?php endforeach; ?>
		</article>
		<?php else: ?>
			<?php echo "if條件錯誤"; ?>
		<?php endif?>
		
	</body>
</html>