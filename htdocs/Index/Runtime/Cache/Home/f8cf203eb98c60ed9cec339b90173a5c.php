<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<title>Comila HTML CSS Template</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

    <!-- CSS -->
    <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
     <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>-->
    <link rel="stylesheet" href="/Index/Home/View/Index/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Index/Home/View/Index/assets/css/style.css">

    <!--/Index/Home/VHomeUser/css/bootstrap.min.css-->
	<!-- stylesheets css -->
	<link rel="stylesheet" href="/Index/Home/View/Index/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Index/Home/View/Index/css/animate.min.css">

  	<link rel="stylesheet" href="/Index/Home/View/Index/css/et-line-font.css">
	<link rel="stylesheet" href="/Index/Home/View/Index/css/font-awesome.min.css">

  	<link rel="stylesheet" href="/Index/Home/View/Index/css/vegas.min.css">
	<link rel="stylesheet" href="/Index/Home/View/Index/css/style.css">

	<!--<link href='http://fonts.useso.com/css?family=Rajdhani:400,500,700' rel='stylesheet' type='text/css'>-->



    <script type="text/javascript" src="/Index/Home/View/Index/jquery-1.8.0.js"></script>
    <!-- Back top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>

    <!-- javscript js -->
    <script src="/Index/Home/View/Index/js/jquery.js"></script>
    <script src="/Index/Home/View/Index/js/bootstrap.min.js"></script>

    <script src="/Index/Home/View/Index/js/vegas.min.js"></script>

    <script src="/Index/Home/View/Index/js/wow.min.js"></script>
    <script src="/Index/Home/View/Index/js/smoothscroll.js"></script>
    <script src="/Index/Home/View/Index/js/custom.js"></script>

</head>
<body>

<!-- preloader section -->
<section class="preloader">
	<div class="sk-circle">
       <div class="sk-circle1 sk-child"></div>
       <div class="sk-circle2 sk-child"></div>
       <div class="sk-circle3 sk-child"></div>
       <div class="sk-circle4 sk-child"></div>
       <div class="sk-circle5 sk-child"></div>
       <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
       <div class="sk-circle8 sk-child"></div>
       <div class="sk-circle9 sk-child"></div>
       <div class="sk-circle10 sk-child"></div>
       <div class="sk-circle11 sk-child"></div>
       <div class="sk-circle12 sk-child"></div>
     </div>
</section>

<!-- home section -->
<section id="home">
	<div class="container">
		<div class="row">

			<div class="col-md-offset-2 col-md-8 col-sm-12">
				<div class="home-thumb">
					<h1 class="wow fadeInUp" data-wow-delay="0.4s">Hello, we are <b style="color: #69ac50">Tour Pal</b></h1>
          			<h3 class="wow fadeInUp" data-wow-delay="1.0s"> 是 否 准 备 好 和 <strong>全 世 界 </strong> 分 享 你 的 <strong>精 彩 瞬 间</strong></h3>
          			<a href="/home.php/home/User/login" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="0.8s">登录</a>
        			<a href="/home.php/home/index/index"  class="btn btn-lg btn-success smoothScroll wow fadeInUp center" data-wow-delay="1.0s">开启发现之旅</a>
				</div>
			</div>

		</div>
	</div>
</section>

<!--

&lt;!&ndash;照片轮播板块&ndash;&gt;
<div  style=" height: 540px; background: #4aac2e">

    <?php if(is_array($photos)): $key = 0; $__LIST__ = $photos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$myImg): $mod = ($key % 2 );++$key;?><img src="/<?php echo ($myImg["addr"]); ?>" align="center" style="background: #5a8bac;width: 180px;height: 180px" alt="tu"><?php endforeach; endif; else: echo "" ;endif; ?>


</div>






&lt;!&ndash; about section &ndash;&gt;
<section id="about">
	<div class="container">
		<div class="row">

      <div class="col-md-6 col-sm-12">
        <img src="/Index/Home/View/Index/images/about-img.png" class="img-responsive wow fadeInUp" alt="About">
      </div>

			<div class="col-md-6 col-sm-12">
				<div class="about-thumb">
					<div class="form-title">
						<h1 class="wow fadeIn" data-wow-delay="0.2s">上传 照片</h1>
						<h3 class="wow fadeInUp" data-wow-delay="0.4s">分 享 故 事 &nbsp;&nbsp; 永 存 回 忆 </h3>
					</div>
					<div class="wow fadeform" data-wow-delay="0.6s">


                            <form action="/index.php/Home/Upload/UploadMore"  enctype="multipart/form-data" method="post">
                                <h2>REGISTER TO <span class="red"><strong></strong></span></h2><br>
                                <label for="pic">图片：</label>

                                    <input type="file" name="photo[]" />

                              <div class="more" ><span id="more" onclick="more(this)">传更多</span></div>
                                <label for="address">地址：</label>
                                <input type="text"  style="height: 30px" id="address" name="address" placeholder="在哪秀了一波..."><br>

                                <label for="text" >描述：</label>
                                <input type="text" style="height: 30px;width: 400px" id="text" name="text" placeholder="想说点什么..."><br>
                               <div style="border-left: 80px"> <button type="submit">上传</button> </div>
                            </form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>





<div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>

&lt;!&ndash; feature section &ndash;&gt;
<section id="feature">
  <div class="container">
    <div class="row">
      
      <svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="svgcolor-light">
        <path d="M0 0 L50 100 L100 0 Z"></path>
      </svg>

      <div class="col-md-4 col-sm-6">
        <div class="media wow fadeInUp" data-wow-delay="0.4s">
          <div class="media-object media-left">
            <i class="icon icon-laptop"></i>
          </div>
          <div class="media-body">
            <h2 class="media-heading">Responsive</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque luctus lacus nulla, eget varius justo tristique ut.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="media wow fadeInUp" data-wow-delay="0.8s">
          <div class="media-object media-left">
            <i class="icon icon-refresh"></i>
          </div>

          <div class="media-body">
            <h2 class="media-heading">Bootstrap</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque luctus lacus nulla, eget varius justo tristique ut.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-8">
        <div class="media wow fadeInUp" data-wow-delay="1.2s">
          <div class="media-object media-left">
            <i class="icon icon-chat"></i>
          </div>
          <div class="media-body">
            <h2 class="media-heading">Support</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque luctus lacus nulla, eget varius justo tristique ut.</p>
          </div>
        </div>
      </div>

      <div class="clearfix text-center col-md-12 col-sm-12">
        <a href="#contact" class="btn btn-default smoothScroll">提点意见</a>
      </div>

    </div>
  </div>
</section>

&lt;!&ndash; contact section &ndash;&gt;
<section id="contact">
	<div class="container">
		<div class="row">

			<div class="col-md-offset-2 col-md-8 col-sm-12">
				<div class="section-title">
					<h1 class="wow fadeInUp" data-wow-delay="0.3s">Get in touch</h1>
					<p class="wow fadeInUp" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
				</div>
				<div class="contact-form wow fadeInUp" data-wow-delay="1.0s">
					<form id="contact-form" method="post" action="#">
                        <div class="col-md-6 col-sm-6">
                          	<input name="name" type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          	<input name="email" type="email" class="form-control" placeholder="Your Email" required>
                        </div>
           			  	<div class="col-md-12 col-sm-12">
				   			<textarea name="message" class="form-control" placeholder="Message" rows="6" required></textarea>
           			  	</div>
						<div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
							<input name="submit" type="submit" class="form-control submit" id="submit" value="传送给我们">
						</div>
					</form>
				</div>
			</div>
	
		</div>
	</div>
</section>

&lt;!&ndash; footer section &ndash;&gt;
<footer>
	<div class="container">
		<div class="row">

      <svg class="svgcolor-light" preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0 L50 100 L100 0 Z"></path>
      </svg>

      <div class="col-md-4 col-sm-6">
        <h2>comila</h2>
          <div class="wow fadeInUp" data-wow-delay="0.3s">
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque luctus lacus nulla, eget varius justo tristique ut. Etiam a tellus magna.</p>
             <p class="copyright-text">Copyright &copy; 2016 Your Company <br>
             More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家"></a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank"></a></p>
          </div>
      </div>

      <div class="col-md-1 col-sm-1"></div>

      <div class="col-md-4 col-sm-5">
        <h2>Our Studio</h2>
        <p class="wow fadeInUp" data-wow-delay="0.6s">
          120-240 aliquam augue libero,<br>
          Convallis in vulputate 10220 <br>
          San Francisco, CA, USA
        </p>
        <ul class="social-icon">
          <li><a href="#" class="fa fa-facebook wow bounceIn" data-wow-delay="0.9s"></a></li>
          <li><a href="#" class="fa fa-twitter wow bounceIn" data-wow-delay="1.2s"></a></li>
          <li><a href="#" class="fa fa-behance wow bounceIn" data-wow-delay="1.4s"></a></li>
          <li><a href="#" class="fa fa-dribbble wow bounceIn" data-wow-delay="1.6s"></a></li>
        </ul>
      </div>

		</div>
	</div>
</footer>

&lt;!&ndash; modal &ndash;&gt;
<div class="modal fade"  style="margin-left: 400px;" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content modal-popup center">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h2 class="modal-title">开启更多功能 </h2>
        </div>
        <form action="/index.php/home/index/index" method="post">
          <input name="fullname" type="text" class="form-control" id="username" placeholder="Nick Name ">
          <input name="email" type="text" class="form-control" id="password" placeholder="Pass Word">
          <input name="submit" type="submit" class="form-control" id="submit" value="let's go ~">
        </form>
        <p>Thank you for your visiting!</p>
      </div>
  </div>
</div>
-->

<script>
        /*var obj =  document.getElementById("more");*/
        function more(obj){
            //console.log(obj)
            obj.innerHTML="<input type='file' name='photo[]' /><span id='more' onclick='more(this)'>传更多</span>";


           //obj.innerHTML("<input type='file' name='photo[]' />");
            // obj.style.backgroundColor = "red";
        }


</script>
</body>
</html>