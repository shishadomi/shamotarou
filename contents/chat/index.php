<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<title>Chat</title>
<style>
.container {
    width: 600px;
}
.box{
    overflow:hidden;
}
.left {
    background-color: #D3D3D3;
    padding: 20px;
    margin: 5px;
    width: 300px;
    float:left;
}
.right {
    background-color: #ADFF2F;
    padding: 20px;
    margin: 5px;
    width: 300px;
    float:right;
 
}
</style>
<script src="http://code.jquery.com/jquery-2.2.4.js"></script>
<script>

function GetQueryString()
{
    var result = {};
    if( 1 < window.location.search.length )
    {
        // 最初の1文字 (?記号) を除いた文字列を取得する
        var query = window.location.search.substring( 1 );

        // クエリの区切り記号 (&) で文字列を配列に分割する
        var parameters = query.split( '&' );

        for( var i = 0; i < parameters.length; i++ )
        {
            // パラメータ名とパラメータ値に分割する
            var element = parameters[ i ].split( '=' );

            var paramName = decodeURIComponent( element[ 0 ] );
            var paramValue = decodeURIComponent( element[ 1 ] );

            // パラメータ名をキーとして連想配列に追加する
            result[ paramName ] = paramValue;
        }
    }
    return result;
}

(function($){
  var settings = {};
  
  var methods = {
    init : function( options ) {
      settings = $.extend({
        'uri'   : 'ws://192.168.33.10:8080',
        'conn'  : null,
        'message' : '#message',
        'display' : '#display'
      }, options);
      $(settings['message']).keypress( methods['checkEvent'] );
      $(this).chat('connect');
    },
    
    checkEvent : function ( event ) {
      if (event && event.which == 13) { //enter押されたら
        var message = $(settings['message']).val(); //mesageタグの中身を変数messageへ
        var param = GetQueryString();
        message += '?';
        message += param['id'];
        message += '?';
        message += param['user'];        
        console.log(message);
        if (message && settings['conn']) { //接続する相手がいれば
          settings['conn'].send(message + '');
          message = message.split( '?' );
          console.log(message);
          $(this).chat('drawText',message[0],'right'); //entarが押された時なので自分のメッセージ(右寄せで表示)
          $(settings['message']).val('');
        }
      }
    },
    
    connect : function () { // チャット相手に接続
      if (settings['conn'] == null) {
        settings['conn'] = new WebSocket(settings['uri']);
        settings['conn'].onopen = methods['onOpen'];
        settings['conn'].onmessage = methods['onMessage'];
        settings['conn'].onclose = methods['onClose'];
        settings['conn'].onerror = methods['onError'];
      }
    },
    
    onOpen : function(event) {
<?php 
	try {
		$except = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);
		$pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
		$stmt = $pdo -> prepare("select * from message_info where room_id = :id ORDER BY time DESC");
		$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$stmt->execute();
		$chatData = $stmt->fetchAll();
	} catch (PDOException $e) {
	    exit('データベース接続失敗。'.$e->getMessage());
	}
?>
	  var alreadyMessage = JSON.parse('<?php echo json_encode($chatData); ?>');

      console.log('サーバに接続');

      var param = GetQueryString();
	  message += param['id'];

      alreadyMessage.forEach(function(element) {
  		if (element[2] == param['user']) {
  			$(this).chat('drawText',element[3],'right');
  		} else {
  			$(this).chat('drawText',element[3],'left');
  		}
	  });
    },
    
    onMessage : function(event) { 
      if (event && event.data) {
        $(this).chat('drawText',event.data,'left'); //相手のメッセージなので左寄せ
      }
    },
        
    onError : function(event) {
      console.log('エラー発生!');
    },
    
    onClose : function(event) {
      console.log('サーバと切断');
      settings['conn'] = null;
      setTimeout(methods['connect'], 1000);
    },
    
    drawText : function (message, align='left') {
      if ( align === 'left' ) {
        var inner = $('<div class="left"></div>').text(message);
      } else {
        var inner = $('<div class="right"></div>').text(message);
      }
      var box = $('<div class="box"></div>').html(inner);
      $('#chat').prepend(box);
    },
  }; // end of methods
  
  $.fn.chat = function( method ) {
    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist' );
    }
  } // end of function
})( jQuery );
 
$(function() {
  $(this).chat({
    'uri':'ws://192.168.33.10:8080',
    'message' : '#message',
    'display' : '#chat'
  });
});
</script>
</head>
<body>
  <input type="text" id="message" size="50" />
  <div id="chat" class="container"></div>
</body>
</html>
