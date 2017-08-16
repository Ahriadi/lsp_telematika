<body id="page-top" data-spy="scroll" data-target=".navbar-custom">


<div id="wrapper">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="top-area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6">
					<p class="bold text-left"> </p>
					</div>
					<div class="col-sm-6 col-md-6">
					<p class="bold text-right">Hubungi Kami Sekarang +62 853 9427 7400</p>
					</div>
				</div>
			</div>
		</div>
        <div class="container navigation">

            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>home">
                    <img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="150" height="40" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#intro">Beranda</a></li>

				<li><a href="#makanan">Makanan</a></li>
				<li><a href="#kontak">Kontak</a></li>

				<?php if ($this->session->userdata('id_user')) {?>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!--span class="badge custom-badge red pull-right">Extra</span-->Belanja <b class="caret"></b></a>
				  <ul class="dropdown-menu">
						<li ><a href="<?php echo base_url();?>belanja">Keranjang Belanja</a></li>
						<li ><a href="<?php echo base_url();?>pembelian">Pembelian</a></li>
				  </ul>
				</li>
				<?php } else {?>
				<?php }?>
				
				  <li>
					<?php if ($this->session->userdata('id_user')) {?>
					  <a href="<?php echo base_url();?>"><?php echo $this->session->userdata('username')?></a>
					<?php } else {?>
					<?php }?>
				  </li>
				  <li>
					<?php if ($this->session->userdata('id_user')) {?>
					  <a href="<?php echo base_url();?>login_user/logout">Log Out</a>
					<?php } else {?>
					  <a href="<?php echo base_url();?>home/login">Login</a>
					<?php }?>
				  </li>

			  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


<!-- ================================================================= -->
<!-- =========================tambahan chatting======================= -->

<!-- TEMPLATE -->
<div id="wgt-container-template" style="display: none">
    <div class="msg-wgt-container">
        <div class="msg-wgt-header">
            <a href="javascript:;" class="online"></a>
            <a href="javascript:;" class="name"></a>
            <a href="javascript:;" class="close">x</a>
        </div>
        <div class="msg-wgt-message-container">
            <table width="100%" class="msg-wgt-message-list">
            </table>
        </div>
        <div class="msg-wgt-message-form">
            <textarea name="message" placeholder="Type your message. Press Shift + Enter for newline"></textarea>
        </div>
    </div>
</div>

<script type="text/x-template" id="msg-template" >
    <tbody>
        <tr class="msg-wgt-message-list-header">
            <td rowspan="2"><img src="<?= base_url('assets/avatar.png') ?>"></td>
            <td class="nama_lengkap"></td>
            <td class="time"></td>
        </tr>
        <tr class="msg-wgt-message-list-body">
            <td colspan="2"></td>
        </tr>
        <tr class="msg-wgt-message-list-separator"><td colspan="3"></td></tr>
    </tbody>
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var chatPosition = [
        false, // 1
        false, // 2
        false, // 3
        false, // 4
        false, // 5
        false, // 6
        false, // 7
        false, // 8
        false, // 9
        false // 10
    ];

    // New chat
    $(document).on('click', 'a[data-friend]', function(e) {
        var $data = $(this).data();
        if ($data.friend !== undefined && chatPosition.indexOf($data.friend) < 0) {
            var posRight = 0;
            var position;
            for(var i in chatPosition) {
                if (chatPosition[i] == false) {
                    posRight = (i * 270) + 20;
                    chatPosition[i] = $data.friend;
                    position = i;
                    break;
                }
            }
            var tpl = $('#wgt-container-template').html();
            var tplBody = $('<div/>').append(tpl);
            tplBody.find('.msg-wgt-container').addClass('msg-wgt-active');
            tplBody.find('.msg-wgt-container').css('right', posRight + 'px');
            tplBody.find('.msg-wgt-container').attr('data-chat-position', position);
            tplBody.find('.msg-wgt-container').attr('data-chat-with', $data.friend);
            $('body').append(tplBody.html());
            initializeChat();
        }
    });

    // Minimize Maximize
    $(document).on('click', '.msg-wgt-header > a.nama_lengkap', function() {
        var parent = $(this).parent().parent();
        if (parent.hasClass('minimize')) {
            parent.removeClass('minimize')
        } else {
            parent.addClass('minimize');
        }
    });

    // Close
    $(document).on('click', '.msg-wgt-header > a.close', function() {
        var parent = $(this).parent().parent();
        var $data = parent.data();
        parent.remove();
        chatPosition[$data.chatPosition] = false;
        setTimeout(function() {
            initializeChat();
        }, 1000)
    });

    var chatInterval = [];

    var initializeChat = function() {
        $.each(chatInterval, function(index, val) {
            clearInterval(chatInterval[index]);
        });

        $('.msg-wgt-active').each(function(index, el) {
            var $data = $(this).data();
            var $that = $(this);
            var $container = $that.find('.msg-wgt-message-container');

            chatInterval.push(setInterval(function() {

                var oldscrollHeight = $container[0].scrollHeight;
                var oldLength = 0;
                $.post('<?= site_url('home/getChats') ?>', {chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                    $that.find('a.name').text(data.name);
                    // from last
                    var chatLength = data.chats.length;
                    var newIndex = data.chats.length;
                    $.each(data.chats, function(index, el) {
                        newIndex--;
                        var val = data.chats[newIndex];

                        var tpl = $('#msg-template').html();
                        var tplBody = $('<div/>').append(tpl);
                        var id = (val.chat_id +'_'+ val.send_by +'_'+ val.send_to).toString();


                        if ($that.find('#'+ id).length == 0) {
                            tplBody.find('tbody').attr('id', id); // set class
                            tplBody.find('td.nama_lengkap').text(val.nama_lengkap); // set name
                            tplBody.find('td.time').text(val.time); // set time
                            tplBody.find('.msg-wgt-message-list-body > td').html(nl2br(val.message)); // set message
                            $that.find('.msg-wgt-message-list').append(tplBody.html()); // append message

                            //Auto-scroll
                            var newscrollHeight = $container[0].scrollHeight - 20; //Scroll height after the request
                            if (newIndex === 0) {
                                $container.animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }
                        }
                    });
                });
            }, 1000));

            $that.find('textarea').on('keydown', function(e) {
                var $textArea = $(this);
                if (e.keyCode === 13 && e.shiftKey === false) {
                    $.post('<?= site_url('home/sendMessage') ?>', {message: $textArea.val(), chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                    });
                    $textArea.val(''); // clear input

                    e.preventDefault(); // stop
                    return false;
                }
            });
        });
    }
    var nl2br = function(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }


    // on load
    initializeChat();
});
</script>


<script src="<?php echo base_url();?>assets/plugins/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
function cek(){

    $.ajax({
        url:"<?php echo base_url();?>home/check_chat",
        cache: false,
        success: function(msg){
            $("#notifikasi").html(msg);
            $("#notifikasi2").html(msg);
			//var audio = new Audio('<?php echo base_url();?>asset/sound/audio_file.mp3');
			//	audio.play();
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){
    cek();

});
</script>
