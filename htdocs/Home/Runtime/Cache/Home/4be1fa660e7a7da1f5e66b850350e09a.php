<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>修改密码</title>
    <style>
        /* reset */
        html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
        article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
        ol,ul{list-style:none;margin:0px;padding:0px;}
        blockquote,q{quotes:none;}
        blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
        table{border-collapse:collapse;border-spacing:0;}
        /* start editing from here */
        a{text-decoration:none;}
        .txt-rt{text-align:right;}/* text align right */
        .txt-lt{text-align:left;}/* text align left */
        .txt-center{text-align:center;}/* text align center */
        .float-rt{float:right;}/* float right */
        .float-lt{float:left;}/* float left */
        .clear{clear:both;}/* clear float */
        .pos-relative{position:relative;}/* Position Relative */
        .pos-absolute{position:absolute;}/* Position Absolute */
        .vertical-base{	vertical-align:baseline;}/* vertical align baseline */
        .vertical-top{	vertical-align:top;}/* vertical align top */
        nav.vertical ul li{	display:block;}/* vertical menu */
        nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
        img{max-width:100%;}
        /*end reset*/
        /****-----start-body----****/
        body{
            background: #0BE093;
            font-family: 'Open Sans', sans-serif;
        }
        body a,form li,.submit input[type="submit"],.new h3 a,.new h4 a{
            transition: 0.1s all;
            -webkit-transition: 0.1s all;
            -moz-transition: 0.1s all;
            -o-transition: 0.1s all;
        }
        body h1 {
            color:#fff;
            text-align: center;
            padding: 1em 0;
            font-size: 2.9em;
        }
        .app-location h2{
            color: #fff;
            text-align: center;
            padding: 1em 0;
            font-size: 1.6em;
            font-weight: 300;
        }
        .app-location{
            width:28%;
            margin:0 auto;
            text-align: center;
            background: #323542;
            padding:4em;
        }
        .location {
            padding: 1em 0;
        }
        .line {
            position: relative;
        }
        .line span{
            position: absolute;
            top: 10%;
            left: 39%;
            background: #5b5c61;
            height: 1px;
            width: 20%;
        }
        form {
            padding: 0% 1%;
        }
        /*-----*/
        .location img {
            margin: 2em 0;
        }
        .app-location input[type="text"],.app-location input[type="password"]{
            width: 81.2%;
            padding: 1.1em 1em 1.1em 4em;
            color: #858282;
            font-size: 16px;
            outline: none;
            background: #fff;
            font-weight: 500;
            border: none;
            font-family: 'Open Sans', sans-serif;
            border-radius: 0.3em;
            -o-border-radius: 0.3em;
            -moz-border-radius: 0.3em;
            -webkit- border-radius: 0.3em;
            margin:0.7em 0;
            background: url("/Public/MyImage/icons.png") no-repeat 14px 16px #474a55;
        }
        .app-location input[type="password"]{
            background: url("/Public/MyImage/icons.png") no-repeat 13px -61px #474a55;
        }
        .submit {
            margin: 1em 0;
        }
        .app-location input[type="submit"]{
            font-size: 20px;
            font-weight: 300;
            color: #fff;
            cursor: pointer;
            outline: none;
            padding: 17px 15px;
            width:100%;
            border:3px solid #0bd38a;
            background: #0bd38a;
            border-radius: 0.3em;
            -o-border-radius: 0.3em;
            -webkit-border-radius: 0.3em;
            -moz-border-radius: 0.3em;
        }
        input[type="submit"]:hover{
            background:none;
            border: 3px solid #0bd38a;
            color: #0bd38a;

        }
        .new {
            margin: 4em 0 1em 0;
        }
        .new h3{
            float:left;
        }
        .new h3 a,.new h4 a{
            color:#78797C;
            font-weight: 400;
            font-size: 1em;
        }
        .new h3 a:hover,.new h4 a:hover{
            text-decoration: underline;
        }
        .new h4{
            float:right;
        }
        /*---------------*/
        .copy-right {
            padding: 3em 1em;
        }
        .copy-right p {
            color: #fff;
            font-size: 1em;
            font-weight:400;
            margin: 0 auto;
            text-align: center;
        }
        .copy-right p a {
            color: #323542;
        }
        .copy-right p a:hover {
            text-decoration: underline;
        }
        /*-----start-responsive-design------*/
        @media (max-width:1440px){
            .app-location{
                width:30%;
            }
            .app-location input[type="text"],.app-location input[type="password"]{
                width: 82.2%;

            }
        }
        @media (max-width:1366px){
            .app-location{
                width:34%;
            }
            .app-location input[type="text"], .app-location input[type="password"] {
                width: 82.7%;
            }
            .line span{
                position: absolute;
                top:10%;
                left: 39%;
                background: #5b5c61;
                height: 1px;
                width: 20%;
            }
            body h1 {
                font-size: 2.6em;
            }

        }
        @media (max-width:1280px){
            .app-location {
                width: 37%;
            }

        }
        @media (max-width:1024px){
            .app-location {
                width: 47%;
            }

        }
        @media (max-width:768px){
            body h1 {
                font-size: 2.4em;
            }
            .location img {
                margin: 2em 0;
                width: 59%;
            }
            .app-location h2 {
                padding: 0.8em 0;
                font-size: 1.6em;
            }
            .line span {
                top: 10%;
                left: 39%;
                height: 1px;
                width: 20%;
            }
            .app-location {
                width: 63%;
            }
            .copy-right {
                padding: 1em 1em;
            }

        }
        @media (max-width:640px){
            body h1 {
                font-size: 2.1em;
            }
            .app-location {
                width: 69%;
            }
            .app-location input[type="text"], .app-location input[type="password"] {
                width: 81%;
            }
        }
        @media (max-width:480px){

            .app-location {
                width: 90%;
                padding: 2em 1em 1em 1em;
            }
            .copy-right p {
                font-size: 0.9em;
            }
            .new h3 a, .new h4 a {
                font-size: 0.9em;
            }
            form {
                width: 82%;
                margin: 0 auto;
            }
            .app-location input[type="text"], .app-location input[type="password"] {
                width: 76.8%;
                margin: 0.4em 0;
            }
        }
        @media (max-width:320px){
            .app-location {
                width: 87%;
                padding: 2em 1em 1em 1em;
            }
            body h1 {
                font-size: 1.5em;
            }
            .copy-right p {
                font-size: 0.85em;
                line-height: 1.7em;
            }
            .app-location input[type="text"], .app-location input[type="password"] {
                width:68%;
                padding: 1em 1em 1em 4em;
                font-size: 15px;
                background: url("../images/icons.png") no-repeat 14px 17px #474a55;
                background-size: 11%;
            }
            .app-location input[type="password"] {
                background: url("../images/icons.png") no-repeat 14px -41px #474a55;
                background-size: 11%;
            }
            .app-location h2 {
                padding: 0.5em 0;
                font-size: 1.2em;
            }
            .new h3 a, .new h4 a {
                font-size: 0.75em;
            }
            .new {
                margin: 2em 0 1em 0;
            }
            .line span {
                top: 10%;
                left: 35%;
                height: 1px;
                width: 29%;
            }
            .submit {
                margin: 0.5em 0;
            }
            .app-location input[type="submit"] {
                font-size: 18px;
                padding: 11px 11px;
            }
            form {
                width: 87%;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body style="width: 550px;height: 1000px; scrolling:no;">
<div class="app-location"  >
    <h2>Update Password</h2>
    <div class="line"><span></span></div>
    <div class="location"><img style="width: 200px;height: 200px;" src="/Public/MyImage/location.png" class="img-responsive" alt="" /></div>
    <form>
        <input type="text" class="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" >
        <input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
        <div class="submit"><input type="submit" onclick="myFunction()" value="修改" ></div>
        <div class="clear"></div>
        <div class="new">
            <h3><a href="#">Forgot password ?</a></h3>
            <div class="clear"></div>
        </div>
    </form>
</div>
</body>
</html>