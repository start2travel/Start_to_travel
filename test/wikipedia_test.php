<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/result-light.css">
	<style id="compiled-css" type="text/css"></style>
	<!-- TODO: Missing CoffeeScript 2 -->
	<script type="text/javascript">


    $(window).load(function(){
      
$(document).ready(function(){
 
    $.ajax({
        type: "GET",
        url: "https://en.wikipedia.org/w/api.php?action=parse&format=json&prop=text&section=0&page=New_York_City&callback=?",
        contentType: "application/json; charset=utf-8",
		
        async: true,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
 
            var markup = data.parse.text["*"];
            var blurb = $('<div></div>').html(markup);
            $('#article').html($(blurb).find('p'));
 
        },
        error: function (errorMessage) {
        }
    });
});

    });

</script>

</head>
<body>
    <div id="article"></div>

  
  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "otbfy679"
      }], "*")
    }
  </script>
</body>
</html>
