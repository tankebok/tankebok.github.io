<!DOCTYPE html>
<?php
  $files = array_slice(scandir("./posts"),3);
?>
<html lang="en">
<head>
<meta charset="utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

  var arrayPHP = <?php echo json_encode($files); ?>;
  $.each(arrayPHP,function (i, elem) {
    $("ul").append("<li><a href=#>"+headerFromFileName(elem.slice(0,-4))+"</a></li>");
    if(i==0) {
      $("a").addClass("active");
    }
  })

  $("#text").load("/posts/"+arrayPHP[0]);
  $("#header").text(headerFromFileName(arrayPHP[0].slice(0,-4)));

  $("a").click(function(){
    $("a").removeClass("active");
    $(this).addClass("active");
    $("#header").text($(this).text());
    $("#text").load("/posts/"+headerToFileName($(this).text()));
  });

  function headerFromFileName(filename) {
    var pos = filename.search("_");
    var len = filename.length;
    return filename.slice(0,pos) + " " + filename.slice(len-2,len) + "/" + filename.slice(len-4,len-2) + "/" + filename.slice(len-8,len-4);
  }
  function headerToFileName(header) {
    var pos = header.search(" ");
    var len = header.length;
    return header.slice(0,pos) + "_" + header.slice(len-4,len) + header.slice(len-7,len-5) + header.slice(len-10,len-8) + ".txt";
  }


});
</script>
<style>
* {
  box-sizing: border-box;
}
html, body {
  width: 100%;
  height: 100%;
  margin: 0px;
  padding: 0px;
  background-color: #fefefa;
}
.grid-container {
  display: grid;
  height: 100%;
  width: 100%;
  padding: 20px;
  grid-template-columns: 1fr 1.33fr 1fr;
  column-gap: 10px;
}
.grid-container > div {
  height: 100%;
}
.content {
  overflow: hidden;
  padding: 20px;
}
.header {
  position: relative;
  width: 100%;
  height: 30px;
  margin-bottom: 10px;
  padding-top: 0px;
  text-align: left;
  font-family: Courier New, monospace;
}
.text {
  position: relative;
  overflow: scroll;
  height: 80%;
  padding: 10px;
  font-family: Didot, serif;
  font-size: 12px;
  text-align: justify;
  text-justify: inter-word;
  white-space: pre-line;
}
ul {
  list-style-type: none;
  text-align: center;
  padding-top: 50px;
}
li {
  margin: 3px;
}
a:link, a:visited {
  text-decoration: none;
  font-family: Courier New, monospace;
  color: black;
}
a.active {
  color: red;
}

</style>
</head>
<body>
<div class="grid-container">
  <div class="item">
  </div>
  <div class="content">
    <div class="header">
      <p id="header"></p>
    </div>
    <div class="text">
      <p id="text"></p>
    </div>
  </div>
  <div class="list">
    <ul>
    </ul>
  </div>
</div>
</body>
</html>
