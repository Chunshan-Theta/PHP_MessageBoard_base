<?PHP
	require('config.php');
	$title=isset($_POST['title'])?$_POST['title']:null;
	$auther=isset($_POST['auther'])?$_POST['auther']:null;
	$content=isset($_POST['content'])?$_POST['content']:null;
	$id=isset($_GET['id'])?$_GET['id']:null;
	$act=isset($_GET['act'])?$_GET['act']:null;
	$roomTag=isset($_GET['roomTag'])?$_GET['roomTag']:null;
	if($roomTag==null){
		header("Location: ./entrance.html");
	}
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
						':auther' => $auther,
						':roomTag' => $roomTag);
			$query = $_link->prepare('INSERT INTO message_board(title,auther,content,posttime,roomTag)VALUE (:title,:auther,:content,CURRENT_TIMESTAMP,:roomTag)');
			$query->execute($data);
			$url = 'text.php?roomTag='.$roomTag;
			header("Location: $url");
		break;
		case 'del':
		/*
			*刪除事件
			*WHERE 表示條件
		*/
			$data = array(':id' => $id);
			$del = $_link->prepare('DELETE FROM message_board WHERE id=:id');
			$del->execute($data);	
			$url = 'text.php?roomTag='.$roomTag;
			header("Location: $url");			
			
		break;
		case 'upd':
		/*
			*更新事件_1
			*第一步：透過id，用"SELECT"來選擇事件 
			*第二步：讀取選擇的事件(fetch(PDO::FETCH_OBJ);)
		*/
			$data = array(':id' => $id);
			$query = $_link->prepare('SELECT * FROM message_board WHERE id=:id');
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
			$query = $_link->prepare('UPDATE message_board SET title=:title,auther=:auther,content=:content WHERE id=:id');
			$query->execute($data);			
			$url = 'text.php?roomTag='.$roomTag;
			header("Location: $url");
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
			$data = array(':roomTag' => $roomTag);
			$view = $_link->prepare('SELECT * FROM message_board WHERE roomTag=:roomTag ORDER by id DESC limit 5000');
			$view->execute($data);
			$result = $view->fetchAll(PDO::FETCH_OBJ);
		
	}

?>
<html>
	<head>
	<meta charset='utf-8'/>
	<meta http-equiv="refresh" content="180">
	<style>
		.container{
			margin: 10px;
			margin-left: auto;
    		margin-right: auto;
			text-align: left;
			width: 95%;
			background: #FFFFFF;
			color: black;
			border-radius: 5px;
			padding-left:10px;
			padding-right:10px;
			
		}
		.containerSub{
			margin-left: 10%;
			margin-right: 3%;
			width: auto;
			border:3px solid lightgray;
			
		}
		article{
			min-height: 80%;
			max-height: 100%;
			width: 100%;
			overflow-y: scroll;
			margin-left: inherit;
    		margin-right: inherit;
    		background-color: #EEE;
		}
		textarea{
			min-width: 30%;
			min-height: 300px;
		}
		form{
			height: 500px;
			width: 100%;
			margin-left: inherit;
    		margin-right: inherit;
    		padding-top: 50px;
		}
		#main{
			display: -webkit-inline-box;
			width:100%;
			height: 95%;
			overflow-x: hidden;
		}
		h6{
			color:gray;
			text-align: right;
		}
		header{
			width: 100%;
			height: 3%;
			text-align: right;
			border-bottom:1px solid #EEE;
			margin-bottom: 10px;
			vertical-align:middle;
		}
		#openBtn{
			background-color: blue;
			color: white;
		}
	</style>
	</head>
	<body>
		<header><button id="openBtn" type="button" onclick="resetWriteWindow();openWriteWindow()">+ Post</button><br></header>
		<?php if($act=='upd'):?><!--更新頁面-->	
			<form method='POST' action='text.php?act=do_upd&id=<?php echo $id; ?>'>
				<label for='title'>標題：</label><input type='text' name='title' id='title' placeholder='<?php echo $result_upd->title; ?>'/></br>
				<label for='auther'>作者：</label><input type='text' name='auther' id='auther' placeholder='<?php echo $result_upd->auther;?>'/></br>
				<label for='content'>內容：</label><textarea type='text' name='content' id='content' placeholder='<?php echo $result_upd->content; ?>'></textarea></br>
				<input type='submit' value='送出' name='upd'/><hr>					
			</form>		
		<?php elseif($act!='do_upd'):?>
			
			<div id="main">
			<article id="board">
				<?php foreach($result as $v):?>
					<?php $pass = stripos($v->title,'##') ?>
					<?php if(empty($pass)):?>
						<div class="container">
							<h1><?php echo $v->title; ?></h1>
							<p><?php echo $v->content; ?></p>
							<h6><?php echo $v->auther; ?>     於<?php echo $v->posttime;?>發文<br>
							#<?php echo $v->id; ?></h6>
							
							<!--<input type='button' value='刪除' name='del' id='del' onclick="location.href='text.php?act=del&roomTag=<?php echo $roomTag; ?>&id=<?php echo $v->id; ?>'"/>
							<input type='button' value='修改' name='upd' id='upd' onclick="location.href='text.php?act=upd&roomTag=<?php echo $roomTag; ?>&id=<?php echo $v->id; ?>'"/>
							-->
							<button type="button" onclick="openWriteWindow();respondsPost('to ##<?php echo $v->id; ?>')">RE:</button>
							
							<br>
							
							
						</div>
					<?php endif?>


					<?php foreach($result as $sv):?>
						<?php if(substr($sv->title,stripos($sv->title,'##')+2)==$v->id):?>
							<div class="container containerSub <?php echo $sv->id; ?>-sub">
								<h3>👋RE:</h3>
								<p><?php echo $sv->content; ?></p>
								<h6><?php echo $sv->auther; ?>     於<?php echo $sv->posttime;?>發文<br>
								#<?php echo $sv->id; ?></h6>
								
								<!--<input type='button' value='刪除' name='del' id='del' onclick="location.href='text.php?act=del&roomTag=<?php echo $roomTag; ?>&id=<?php echo $sv->id; ?>'"/>
								<input type='button' value='修改' name='upd' id='upd' onclick="location.href='text.php?act=upd&roomTag=<?php echo $roomTag; ?>&id=<?php echo $sv->id; ?>'"/><br>-->
								
							</div>
						<?php endif?>
					<?php endforeach; ?>
					<?php $num++; ?>
				<?php endforeach; ?>
			</article>


			<!-- 
			
				*點擊下方送出後傳至(action='text.php?act=insert)這個畫面
				*因為act被賦予"insert"數據，所以觸發switch(act)中的 case'insert':
			-->	
			<form id="form1" method='POST' action='text.php?act=insert&roomTag=<?php echo $roomTag; ?>'> 
				標題<input type='test' name='title' id='title'/></br>
				作者<input type='test' name='auther' id='auther'  /><button id="setNameBtn" type="button" onclick="setname();">SET!</button></br>
				內容<br><textarea type ='text' name='content' id='content'></textarea></br>		
				<input type='submit' value='送出' id='insert'/>
			</form>
			</div>
		<?php else: ?>
			<?php echo "if條件錯誤"; ?>
		<?php endif?>
		
	</body>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
	<script>
		$('#auther').val($.cookie('auther'));
		if($.cookie('auther')!=null){
			$('#setNameBtn').hide();
			$('#auther').attr('readonly', true);
		}
		function setname(){
			var varAuther = $('#auther').val();
			$.cookie('auther',varAuther);
			console.log(varAuther);
			console.log($.cookie('auther'));
			$('#setNameBtn').hide();
			$('#auther').attr('readonly', true);
		}
		$("#form1").submit(function(){
			$("#insert").attr('disabled', true);
			if ($("#content").val() == '') {
				if(!confirm("content is empty!! Are you sure?")){
					$("#insert").attr('disabled', false);
					return false
				};

			}
			if ($("#title").val() == '') {
				if(!confirm("title is empty!! Are you sure?")){
					$("#insert").attr('disabled', false);
					return false
				};

			}
			if ($("#auther").val() == '') {
			    if(!confirm("auther is empty!! Are you sure?")){
					$("#insert").attr('disabled', false);
					return false
				};

			}

	});
		function respondsPost(titleText){
			$('#title').val(titleText);
			$('#title').attr('readonly', true);

		}
		function openWriteWindow(titleText){
			var articleWidth = $('article').css("width").substring(0,$('article').css("width").length-2);
			var bodyWidth70 = $('body').css("width").substring(0,$('body').css("width").length-2)*0.7;
			console.log(articleWidth);
			console.log(bodyWidth70);
			if(articleWidth>bodyWidth70){
				$('#board').css("width","65%");
				$('#openBtn').html("close window");
			}else{
				$('#board').css("width","100%");
				$('#openBtn').html("+ Post");
			}
			


		}
		function resetWriteWindow(){
			$('#title').val("");
			$('#title').attr('disabled', false);
		}
	</script>
</html>
