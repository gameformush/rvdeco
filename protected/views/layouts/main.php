<!DOCTYPE html>
<html class="desktop landscape getusermedia chrome chrome61">
	<head>
		

		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, min-width=480px, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
		
		<meta name="author" content="https://github.com/gameformush">

		<? if(startsWith($_SERVER['REQUEST_URI'], "/calc/")) { ?>
		 <link rel="stylesheet" href="/my/vendor.css">
		 <link rel="stylesheet" href="/my/common.css">
		 <link rel="stylesheet" href="/my/css.css">

		<? }?>
		<link rel="icon" type="image/png" href="/my/favicon.png">

		<title><?php echo $this->pageTitle; ?></title>

		<link rel="stylesheet" href="/my/font-awesome.css">
		<link rel="stylesheet" href="/js/jquery.fancybox-1.3.4.css">
		<link rel="stylesheet" href="/my/fontawesome.min.css">
		<link rel="stylesheet" href="/my/messagebox.min.css">

		<link rel="stylesheet" href="/my/norm.css">
		<link rel="stylesheet" href="/my/simplelightbox.min.css">
		<link rel="stylesheet" href="/my/main.css">

		


		<link href="https://fonts.googleapis.com/css?family=Suez+One" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="/js/jquery.js"></script>
		<script src="/js/jquery.fancybox-1.3.4.pack.js"></script>
		<script src="/js/jquery.mousewheel-3.0.4.pack.js"></script>
		<script src="/my/vendor.js"></script>
		<script src="/my/messagebox.min.js"></script>
		<script src="/my/common.js"></script>

		

		<style type="text/css">
			
			TD, TH {
			text-align: center;
			}
			TH {
			vertical-align: middle;
			}
			.im-caret {
			-webkit-animation: 1s blink step-end infinite;
			animation: 1s blink step-end infinite;
			}
			@keyframes blink {
			from, to {
			border-right-color: black;
			}
			50% {
			border-right-color: transparent;
			}
			}
			@-webkit-keyframes blink {
			from, to {
			border-right-color: black;
			}
			50% {
			border-right-color: transparent;
			}
			}
			.im-static {
			color: grey;
			}
			.dm-overlay {
    display:none;
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.65);
    overflow: auto;
    width: 100%;
    height: 100%;
    z-index: 9999;
}
/* Ð°ÐºÑ‚Ð¸Ð²Ð¸Ñ€ÑƒÐµÐ¼ Ð¼Ð¾Ð´Ð°Ð»ÑŒÐ½Ð¾Ðµ Ð¾ÐºÐ½Ð¾ */

.dm-overlay:target {
    display: block;
    -webkit-animation: fade .6s;
    -moz-animation: fade .6s;
    animation: fade .6s;
}
/* Ð±Ð»Ð¾Ñ‡Ð½Ð°Ñ Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ð° */

.dm-table {
    display: table;
    width: 100%;
    height: 100%;
}
/* ÑÑ‡ÐµÐ¹ÐºÐ° Ð±Ð»Ð¾Ñ‡Ð½Ð¾Ð¹ Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ñ‹ */

.dm-cell {
    display: table-cell;
    padding: 0 1em;
    vertical-align: middle;
    text-align: center;
}

.dm-modal {
    display: inline-block;
    padding: 20px;
    min-width: 300px;
    background: #fff;
    -webkit-box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.22), 0px 19px 60px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.22), 0px 19px 60px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.22), 0px 19px 60px rgba(0, 0, 0, 0.3);
    color: #000;
    text-align: left;
}
.pl-left,
.pl-right {
    width: 25%;
    height: auto;
}
/* Ð¼Ð¸Ð½Ð¸Ð°Ñ‚ÑŽÑ€Ð° ÑÐ¿Ñ€Ð°Ð²Ð° */

.pl-right {
    float: right;
    margin: 5px 0 5px 15px;
}
/* Ð¼Ð¸Ð½Ð¸Ð°Ñ‚ÑŽÑ€Ð° ÑÐ»ÐµÐ²Ð° */

.pl-left {
    float: left;
    margin: 5px 15px 5px 0;
}

.dm-overlay button {
    background: black;
    padding: 10px 20px;
    color: #FFFFFF;
    border: none;
    outline: none;
    text-align: center;
    margin: 0 auto;
    display: block;
    margin-top: 5%;
}


@-moz-keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1
    }
}
@-webkit-keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1
    }
}
@keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1
    }
}
			.fancybox-show-toolbar {
				z-index:999999!important; 	
			}
			.fancybox-close-small {
				display:none;	
			}
		</style>
		<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter48472778 = new Ya.Metrika({
                    id:48472778,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48472778" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	</head>
	<body>
		<?
			$mod = Obsh::model()->find("id = '1'");
			$fon = json_decode($mod->fon_image, true);
		?>
		
		<? $this->widget('ext.googleAnalytics.EGoogleAnalyticsWidget',
							array('account'=>'UA-115476487-1','domainName'=>'rvdeco.com')
						);?>
		
		<aside class="aside-menu">
		  <div class="menu-icon">
		    <label for="main-menu"><i class="fas fa-bars"></i></label>
		    <input id="main-menu" type="checkbox">
		    <nav>
		      <div class="hider"></div>
		      <div class="overlap-wrapper">
		        <div class="brand-menu">
		          rvdeco
		        </div>
		        <div class="phone">
					<span class="icon phone-icon"></span><span><a href="tel:0650354752">06 50 35 47 52</a></span>
		        </div>
		        <div class="email">
		            <span class="envelop-icon icon"></span><span><a href="mailto:rvdeco@yahoo.com">rvdeco@yahoo.com</a></span>
		        </div>
		        <ul class="menu-items clear-fix">
					<? function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
?>
		          <a "<? if($_SERVER['REQUEST_URI'] == "/") { ?> class="active"<? } ?> href="/"><li>главная</li></a>
		          <a "<? if(startsWith($_SERVER['REQUEST_URI'], "/calc/")) { ?> class="active"<? } ?> href="/calc/"><li>калькулятор</li></a>
		          <a "<? if(startsWith($_SERVER['REQUEST_URI'], "/gallery/")) { ?> class="active"<? } ?> href="/gallery/show/id/10"><li>галерея</li></a></li>
		          <a "<? if(startsWith($_SERVER['REQUEST_URI'], "/faq/")) { ?> class="active"<? } ?> href="/faq/"><li>вопрос/ответ</li></a>
		          <a "<? if(startsWith($_SERVER['REQUEST_URI'], "/reviews/")) { ?> class="active"<? } ?> href="/reviews/"><li>отзывы</li></a>
		          <a "<? if(startsWith($_SERVER['REQUEST_URI'], "/feedback/")) { ?> class="active"<? } ?> href="/feedback/"><li>контакты</li></a>
		        </ul>
		      </div>
		      <div class="copy-menu">  
		          <span>&copy;</span> <p>  Copyright 2018. <br> All rights reserved.Imprint Privacy Policy</p>
		      </div>
		    </nav>
		  </div>
		  <div class="brand">
		    <div class="rotated-text">
		       <span class="rotated-text__inner"><a class="brand-text" href="#">RVDECO</a></span>
		    </div>
		  </div>
		  <div class="feedback-menu">
		    <div class="call-us-icon">
		        <a href="tel:0650354752"><span class="icon phone-icon"></span></a>
		    </div>
		    <div class="email-icon">
		        <a href="mailto:rvdeco@yahoo.com"><span class="envelop-icon icon"></span></a>
		    </div>
		  </div>
		  <div class="copyright">
		      <div class="rotated-text">
		        <span class="rotated-text__inner"> Copyright 2018. <br> All rights reserved.Imprint Privacy Policy</span>
		      </div>
		    <span class="copy">&copy;</span>
		  </div>
		</aside>

	
		<? if($_SERVER['REQUEST_URI'] != '/') { ?>
		<div class="content-render">
			<div class="container-my">
				<?=$content?>
			</div>
		</div>
		<? } ?>
		<? if($_SERVER['REQUEST_URI'] == '/') { ?>
			<div class="container-my">
				<section id="front">
				  <nav class="top clearfix">
				    <div class="front-left">
				      <div class="social">
				        <a href=""><span class="icon insta-icon"></span></a>
				        <a href=""><span class="icon facebook-icon"></span></a>
				        <a href=""><span class="icon twiter-icon"></span></a>
				      </div>
				      <a class="logo" href="/"></a>
				    </div>
				    <div class="front-right">
				      <a href="">вход | регистрация</a>
				    </div>
				  </nav>

				  <div class="center-block">
				    <p class="spec">Специалисты №1 <br> по ремонту</p>
				    <div class="separator-front"></div>
				    <p class="dreams">Вы мечтаете об интерьере, <br> похожем на вас,мы помогаем реализова</p>
				    <a href="/calc/" class="calc"><span class="icon calc-icon"></span><span>Рассчитать</span></a>
				  </div>
				  <div class="bottom-buttons">
				      <a href="mailto:rvdeco@yahoo.com"><span class="icon env-big-icon red-circle"></span></a>
				    <a href="tel:0650354752"><span class="icon phone-big-icon red-circle"></span></a>
				  </div>
				</section>
				<section id="why-us">
				    <div class="section-title">
				      <div class="bg"><p>почему</p><p class="second">мы?</p> </div>
				      <p class="actual"><span class="underline">поч</span>ему мы?</p>
				    </div>
				    <div class="blob-block">
				      <div class="blob">
				        <img src="/images/blob.png" alt="">
				      </div>

				      <p><span class="point-icon icon"></span> более 10 000 км нанесенной краски</p>
				      <p><span class="point-icon icon"></span> более 100 выполненных ремонтов</p>
				      <p><span class="point-icon icon"></span> более 150 отремонтированных квартир</p>
				      <p><span class="point-icon icon"></span> более 10 000 потраченных розеток и выключателей</p>
				      <p><span class="point-icon icon"></span> более 150 довольных клиентов</p>
				      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				         viewBox="0 0 960 560" enable-background="new 0 0 960 560" xml:space="preserve">
				      <path fill="none" stroke="#000000" stroke-width="5" stroke-miterlimit="10" d="M0,0c102,0,184.8,82.7,184.8,184.8
				        c0,102-82.7,184.8-184.8,184.8"/>
				      </svg>
				    </div>
				    <div class="blob-block-modile">
				      <div class="blob">
				        <img src="/images/blob-separate.png" alt="">
				      </div>
				      <div class="m-list-item"><span class="list-modile-regular"></span> <p>более 10 000 потраченных розеток и выключателей</p></div>
				      <div class="m-list-item"><span class="list-modile-regular"></span> <p>более 150 отремонтированных квартир</p></div>
				      <div class="m-list-item"><span class="list-modile-regular"></span> <p>более 150 довольных клиентов</p></div>
				      <div class="m-list-item"><span class="list-modile-regular"></span> <p>более 100 выполненных ремонтов</p></div>
				      <div class="m-list-item"><span class="list-modile-last"></span> <p>более 10 000 км нанесенной краски</p></div>
				    </div>
				</section>
				<section id="trust">
				     <div class="section-title">
				      <div class="bg"><p>нам</p><p class="second">доверяют</p></div>
				      <p class="actual"><span class="underline">нам</span> доверяют</p>
				    </div>
				    <div class="companys">
				    	<div class="row">
				    	  <img src="/images/company4.png" alt="">
				    	  <img src="/images/company2.png" alt="">
				    	</div>
				    	<div class="row">
				    	  <img src="/images/company1.png" alt="">
				    	  <img src="/images/company3.png" alt="">
				    	</div>
				    </div>
				</section>
				<section id="contact-us">
				  
				    <div class="wrapper">
				      <div id="newsletter">
				          <div class="section-title">
				              <div class="bg"><p>свяжись</p> <p class="second">с нами</p></div>
				              <p class="actual"><span class="underline">свя</span>жись с нами</p>
				            </div>
				        <div class="form-title">
				            <div class="block-left">
				                <h3>newsletter</h3>
				                <p>Subscribe to our monthly newslet-<br>ter.  We promise to keep it minimal.</p>
				            </div>
				            <form class="form" action="#">
				              <div class="block-left">
				                  <input type="text" name='email' placeholder="email address">
				              </div>
				              <input type="submit" value="stay updated">
				            </form>
				        </div>
				      </div>
				      <div id="massage-us" >
				        <div class="form-title">
				            <h3>message us</h3>
				            <p>Feel free to drop us a message. With <br>your feedback and help us improve <br> rvdeco.</p>
				        </div>
				        <form class="form" action="#">
				          <div class="group">
				            <input type="text" name="name" placeholder="name">
				            <input type="text" name="email" placeholder="email">
				            <textarea name="message" cols="30" rows="10" placeholder="your message"></textarea>
				            <input type="submit" value='send message'>
				          </div>
				        </form>
				      </div>
				    </div>
				</section>
			</div>
		<? } ?>
		<script>
			$(".primary-menu__container a").each(function () {
				var url = window.location.href;
				var current = $(this).attr("href");
				if (url.indexOf(current) + 1 && current.length > 3) {
					$(this).addClass("practive");
					$(".primary-menu__container a").first().removeClass("practive");
				} else if (current == "/") {
					$(this).addClass("practive");
				}
			});
			$("body").on("click", ".send-contact", function () {
				var name = $("#rname").val();
				var email = $("#remail").val();
				var message = $("#rmessage").val();
				error = 0;
				if (name == "") {
					$("#rname").css("background", "#ffe7e7");
					error = 1;
				} else {
					$("#rname").css("background", "#fff");
				}
				if (email == "") {
					$("#remail").css("background", "#ffe7e7");
					error = 1;
				} else {
					$("#remail").css("background", "#fff");
				}
				if (message == "") {
					$("#rmessage").css("background", "#ffe7e7");
					error = 1;
				} else {
					$("#rmessage").css("background", "#fff");
				}
				if (error == 0) {
						
				}
				return false;
			});
		</script>
		<script>
	$("body").on("click", ".send-contact", function () {
		var name_model = "feedback";
		var form = $('form')[0]; 
		var formData = new FormData(form);
		var type = $(this).data("type");
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/feedback/create/",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				if (data.status == "ok") {
					if (type == "popup") {
						$("#resform").html("Votre demande est envoyé avec succès!<br/><br/>Merci, votre demande sera traité dans les meilleurs délais, on vous revient au plus vite!");
					} else {
						$(".widget-form").html("Votre demande est envoyé avec succès!<br/><br/>Merci, votre demande sera traité dans les meilleurs délais, on vous revient au plus vite!");
					}
				} else {
					$.each(data, function(key, val) {
						if (key == "Feedback_name_text") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Champs obligatoire à remplir");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						} else if (key == "Feedback_E-mail_text") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Renseigner votre e-mail pour qu'on puisse vous faire un retour.");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						} else if (key == "Feedback_message_bigtext") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Votre message doit apparaitre ici");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						}
					});
				}
			},
		});
		return false;
	});
	
	$('#get_val .span-before').click(e => {
	        $.MessageBox("Alert Message Here");
	})
	/*
	$('.bottom-buttons .icon').click(e => {
		$.MessageBox({
			  input    : true,
			  message  : "What's your name?"
			}).done(function(data){
			  if ($.trim(data)) {
			    $.MessageBox("Hi <b>"+data+"</b>!");
			  } else {
			    $.MessageBox("You are shy, aren't you?");
			  }
			});
	})
	*/
</script>
		<style>
			@media screen and (max-width: 700px) {
	#calculator_result {
		font-size:0.6em!important
	}
				.calculator__body {
						font-size:0.6em!important
	
				}
				.item-click {
											font-size:0.6em!important

				}
				.glyphicon-info-sign {
				display:none;	
				}
				.calculator__categories {
				font-size:0.6em!important	
				}
				.remove {
				    padding: 2px 6px;
    				font-size: 7px;	
				}
				.remove-all {
				    padding: 2px 6px;
    				font-size: 7px;	
				}
				.btn {
					
				}
}
			</style>
		<div class="dm-overlay" id="push_error" style="display: none; z-index:99993;">
    <div class="dm-table">
        <div class="dm-cell">
            <div class="dm-modal">
                <div id = "mymodal"></div>
            </div>
        </div>
    </div>
</div>

<script>
  let id;
  function start() {
    if (id) return;
    var counter = -1;


    var svgContainer = document.getElementById("outerWrapper");
    var ns = "http://www.w3.org/2000/svg";
    var svg = $('.blob-block svg path').get(0);

    var straightLength = svg.getTotalLength();

    var stars = $('.blob-block p').get()

    function moveStar() {
      if (counter > 0.1) {

        return;
      } 


        counter += 0.004;


      for (var i = stars.length - 1; i >= 0; i--) {
        $(stars[i]).css("left",svg.getPointAtLength((counter + i / stars.length) * straightLength).x*1.35 + 211 + 'px')
        $(stars[i]).css("top",svg.getPointAtLength((counter + i / stars.length) * straightLength).y*1.35 + 80 + 'px')
        $(stars[i]).css("opacity", (counter + i / stars.length) > 0.05 ? 1 : 0 )
      }

      requestAnimationFrame(moveStar);
    }
    id = requestAnimationFrame(moveStar);
  }


  $(window).scroll(function() {
     var hT = $('#why-us').offset().top,
         hH = $('#why-us').outerHeight(),
         wH = $(window).height(),
         wS = $(this).scrollTop();

     if (wS > (hT+hH-wH)){
           start()
    }
  });
	
	document.addEventListener('touchmove', function (event) {
  if (event.scale !== 1) { event.preventDefault(); }
}, false);
	
	var lastTouchEnd = 0;
document.addEventListener('touchend', function (event) {
  var now = (new Date()).getTime();
  if (now - lastTouchEnd <= 300) {
    event.preventDefault();
  }
  lastTouchEnd = now;
}, false);
</script>
	</body>
</html>