<html>
<head>
<title>Tyler, The Creator Discography</title>
<style>
	body {font-family:georgia;
        background-color: #F1B9C3;
        color: #715437;}

  .album{
    border:1px solid #F7F2D1;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:20px;
    top:20px;
  }

  .pic img{
	max-width:100px;
  }

  .h4{
    color: #add8e6;
  }
  
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function tylerTemplate(album){
  return `
      <div class="album">
        <b>Album Title</b>: ${album.AlbumTitle}<br />
        <b>Release Date</b>: ${album.ReleaseDate}<br />
        <b>Genre</b>: ${album.Genre}<br />
        <b>Studio</b>: ${album.Studio}<br />
        <b>Label</b>: ${album.Label}<br />
        <b>Producer</b>: ${album.Producer}<br />
        <b>Length</b>: ${album.Length}<br />
        <b>Best Single</b>: ${album.BestSingle}<br />
        <b>Ranking</b>: ${album.Ranking}<br />
        <div class="pic"><img src="thumbnails/${album.Image}" /></div>  
      </div> 
  `;
}

  
$(document).ready(function() { 

$('.category').click(function(e){
e.preventDefault(); //stop default action of the link
cat = $(this).attr("href");  //get category from URL
 
var request = $.ajax({
url: "api.php?cat=" + cat,
method: "GET",
dataType: "json"
});
request.done(function( data ) {
console.log(data);

  //place data.title on page
  $("#albumtitle").html(data.title);

  //CLear previous films
  $("#albums").html("");

 //loop through data.films and place on page 
$.each(data.albums,function(i,item){
  let myData = tylerTemplate(item);
  $("<div></div>").html(myData).appendTo("#albums");
})
  
  /*
let myData = JSON.stringify(data,null,4);
myData = "<pre>" + myData + "</pre>";
$("#output").html(myData);
 */ 
  
});
request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
  });
}); 


</script>
</head>
	<body>
	<h1>Tyler, The Creator Discography</h1>
  <h4 style="color: #60aec8">This webpage uses jQuery and AJAX to create a webpage that changes the display on the screen after a click action.</h2>
		<a href="year" class="category" style="color: #715437">Tyler, The Creator Albums By Year</a><br />
		<a href="ranking" class="category" style="color: #715437">Tyler, The Creator Albums By Ranking</a>
		<h3 id="albumtitle"></h3>
		<div id="albums"></div>
		<div id="output"></div>
	</body>
</html>
