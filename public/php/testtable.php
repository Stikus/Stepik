<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
	<head>
		<title>Таблица организаций</title>
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<style>
		.inp { width: 100%; }
		.links { word-break: break-all;}
		</style>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 		<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready(function() {
			    // Setup - add a text input to each footer cell
			    $('#orgsTable tfoot th').each( function () {
			        var title = $(this).text();
			        $(this).html( '<input type="text" class="inp" placeholder="Поиск '+title+'" />' );
			    } );
			 
			    // DataTable
			    var table = $('#orgsTable').DataTable(  {
			        "language": {
					  "processing": "Подождите...",
					  "search": "Поиск:",
					  "lengthMenu": "Показать _MENU_ записей",
					  "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
					  "infoEmpty": "Записи с 0 до 0 из 0 записей",
					  "infoFiltered": "(отфильтровано из _MAX_ записей)",
					  "infoPostFix": "",
					  "loadingRecords": "Загрузка записей...",
					  "zeroRecords": "Записи отсутствуют.",
					  "emptyTable": "В таблице отсутствуют данные",
					  "paginate": {
					    "first": "Первая",
					    "previous": "Предыдущая",
					    "next": "Следующая",
					    "last": "Последняя"
					  },
					  "aria": {
					    "sortAscending": ": активировать для сортировки столбца по возрастанию",
					    "sortDescending": ": активировать для сортировки столбца по убыванию"
					  }
					}
			    } );
			 
			    // Apply the search
			    table.columns().every( function () {
			        var that = this;
			 
			        $( 'input', this.footer() ).on( 'keyup change', function () {
			            if ( that.search() !== this.value ) {
			                that
			                    .search( this.value )
			                    .draw();
			            }
			        } );
			    } );
			} );
		</script>
		<script>
			function newMyWindow1(href) {
			  var d = document.documentElement,
			      h = 700,
			      w = 900,
			      myWindow = window.open(href, 'myWindow', 'scrollbars=1,height='+Math.min(h, screen.availHeight)+',width='+Math.min(w, screen.availWidth)+
			      	',left='+Math.max(0, ((d.clientWidth - w)/2 + window.screenX))+',top='+Math.max(0, ((d.clientHeight - h)/2 + window.screenY)));
			      // абзац для Chrome
			      if (myWindow.screenY >= (screen.availHeight - myWindow.outerHeight)) {myWindow.moveTo(myWindow.screenX, (screen.availHeight - myWindow.outerHeight))};
			      if (myWindow.screenX >= (screen.availWidth - myWindow.outerWidth)) {myWindow.moveTo((screen.availWidth - myWindow.outerWidth), myWindow.screenY)};
				return true;
			}
		</script>
	</head>
	<body>
		<table id="orgsTable" class="display" cellspacing="0" width="100%" border="1px">
		<?
			$dbcon = mysql_connect("localhost", "mysql", "mysql"); 
			mysql_select_db("Biobank_test", $dbcon);
			if (!$dbcon)
			{
				echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error(); exit();
			}
			else 
			{
				if (!mysql_select_db("Biobank_test", $dbcon))
				{
					echo("<p>Выбранной базы данных не существует!</p>");
				}
			}
			$res = mysql_query('select * from `orgs`');
		?>
		    <thead>
		        <tr>
		        	<? $row = mysql_fetch_assoc($res) ?>
		            <th>ID</th>
<!--		            <th><?echo $row['name'] ?></th>
		            <th><?echo $row['usable'] ?></th>
		            <th><?echo $row['doubles'] ?></th> -->
		            <th><?echo $row['fullname'] ?></th>
		            <th><?echo $row['shortname'] ?></th>
		            <th><?echo $row['abbr'] ?></th>
		            <th><?echo $row['parent'] ?></th>
		            <th>ИНН</th>
		            <th><?echo $row['INN link'] ?></th>
		            <th><?echo $row['sourse link'] ?></th>
		            <th>Дата актуализации</th>
		            <th><?echo $row['comment'] ?></th>
		        </tr>
		    </thead>
		    <tbody>
		    	<? while($row = mysql_fetch_assoc($res))
						{
							?>
							<tr>
					            <th><?echo $row['id'] ?></th>
<!--					            <th><?echo $row['name'] ?></th>
					            <th><?echo $row['usable'] ?></th>
					            <th><?echo $row['doubles'] ?></th> -->
					            <th><?echo $row['fullname'] ?></th>
					            <th><?echo $row['shortname'] ?></th>
					            <th><?echo $row['abbr'] ?></th>
					            <th><?echo $row['parent'] ?></th>
					            <th><?echo $row['INN'] ?></th>
					            <th class="links"><a href="<? echo $row['INN link']?>" onclick="return !newMyWindow1(this.href)"><? echo $row['INN link']?></a></th>
					            <th class="links"><a href="<? echo $row['sourse link']?>" onclick="return !newMyWindow1(this.href)"><? echo $row['sourse link']?></a></th>
					            <th><?if ($row['date']>0) {echo $row['date']; }?></th>
					            <th><?echo $row['comment'] ?></th>
							</tr>
							<?
						}
				?>
		    </tbody>
			<tfoot>
		        <tr>
		        	<?
		        	$head = mysql_query('select * from `orgs` where `id`=0');
		        	$rowhead = mysql_fetch_assoc($head) 
		        	?>
		            <th style="padding: 5px">ID</th>
<!--		            <th style="padding: 5px"><?echo $rowhead['name'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['usable'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['doubles'] ?></th> -->
		            <th style="padding: 5px"><?echo $rowhead['fullname'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['shortname'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['abbr'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['parent'] ?></th>
		            <th style="padding: 5px">ИНН</th>
		            <th style="padding: 5px"><?echo $rowhead['INN link'] ?></th>
		            <th style="padding: 5px"><?echo $rowhead['sourse link'] ?></th>
		            <th style="padding: 5px">Дата актуализации</th>
		            <th style="padding: 5px"><?echo $rowhead['comment'] ?></th>
		        </tr>
		    </tfoot>		
		</table>
		<div align='center'	style='border: 0px solid blue; position:relative; bottom:20px; width:100%;'>
			<a href='exit.php'>Выйти на главную страницу</a>
		</div>
	</body>
</html>