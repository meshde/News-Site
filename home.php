<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.content {
  transition: 0.3s;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>



<center>
	<h1>
	Menews.com
	</h1>
	<nav>
		News  | Videos | Profile
	</nav>
</center>
<aside id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a id="India">India</a>
  <a id="World">World</a>
  <a id="Business">Business</a>
  <a id="Sports">Sports</a>
  <a id="Health">Health</a>
</aside>


<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script>
window.onload = function() {
	var links = document.getElementsByTagName("a");
	for(var i = 0; i < links.length; i++){
		links[i].innerHTML = links[i].id;
		links[i].onclick = function() {
			loadDoc(this.id);
		};
	}
	loadDoc('Home');
};

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("content").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("content").style.marginLeft = "25px";
}

function loadDoc(type) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "news.php?type="+type, true);
  xhttp.send();
}

</script>
     
<main id='content'>
  <?php 
     include('helper.php');
     
$content = '<style>

.item {
  float: left;
  
  width: 100%;
  height: 150px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
  overflow: hidden;
  background: white;
  color: #808080;
  border-radius: 6px;
  padding-bottom: 0px;
  padding-top: 0px;
  box-shadow: 4px 4px rgba(0, 0, 0, .3);
}
.item img {
padding-top: 5px;
    padding-left: 1px;
    padding-bottom: 5px;
    padding-right: 5px;
    height: 88%;
    width: 25%;
    border-radius: 10px;
}
</style>';
     $content .= getfeed('https://timesofindia.indiatimes.com/rssfeeds/1221656.cms');
     echo $content;
?>
</main>
</body>
</html>
