<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <title>Start To Travel</title>
</head>
<body>
<?php
include("header.php");
?>

<div class="slideshow">
	<div class="slideshow-container">

	<div class="mySlides fade">
	  <div style="margin-left: 50px;">
	  <p class="text">Кaкво искате да видите</p><br><br><br>
	<label class="container">Исторически забележителности
	  <input id="istoria" type="checkbox" onchange="initMap()" name="checkbox">
	  <span class="checkmark"></span>
	</label>
	<label class="container">Природни забележителности
	  <input id="priroda" type="checkbox" onchange="initMap()" name="checkbox">
	  <span class="checkmark"></span>
	</label>
	<label class="container">Културни забележителности
	  <input id="kultura" type="checkbox" onchange="initMap()" name="checkbox">
	  <span class="checkmark"></span>
	</label>
	<label class="container">Еко пътеки
	  <input id="eko" type="checkbox" onchange="initMap()" name="checkbox">
	  <span class="checkmark"></span>
	</label>
		</div>
	</div>

	<div class="mySlides fade">
	  <div id="panel" style="margin-left: 50px;">
		<div>
			<div class="autocomplete">
				<input  id="start" type="text" name="myCountry" placeholder="Начална точка">
			</div>
			<select multiple id="waypoints">	
				<option value="Пловдив">Пловдив</option>
				<option value="Стара Загора">Стара загора</option>
			</select>
			<br>
	
			<div class="autocomplete">
				<input  id="end" type="text" name="myCountry" placeholder="Крайна точка">
			</div>
		</div>

	</div>
	</div>


	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>
		<div id="directions-panel"></div>
			<br>
			<input type="submit" id="submit">
	</div>

<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</div>

   
   
   <div id="map"></div>
   
   
   
      <script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Айтос","Аксаково","Алфатар","Антоново","Априлци","Ардино","Асеновград","Ахелой","Ахтопол","Балчик","Банкя","Банско","Баня","Батак","Батановци","Белене","Белица","Белово","Белоградчик","Белослав","Берковица","Благоевград","Бобов дол","Бобошево","Божурище","Бойчиновци","Болярово","Борово","Ботевград","Брацигово","Брегово","Брезник","Брезово","Брусарци","Бургас","Бухово","Българово","Бяла, област Варна","Бяла, област Русе","Бяла Слатина","Бяла черква","Варна","Велики Преслав","Велико Търново","Велинград","Ветово","Ветрен","Видин","Враца","Вълчедръм","Вълчи дол","Върбица","Вършец","Габрово","Генерал","Тошево","Главиница","Глоджево","Годеч","Горна Оряховица","Гоце Делчев","Грамада","Гулянци","Гурково","Гълъбово","Две могили","Дебелец","Девин","Девня","Джебел","Димитровград","Димово","Добринище","Добрич","Долна баня","Долна","Митрополия","Долна Оряховица","Долни Дъбник","Долни чифлик","Доспат","Драгоман","Дряново","Дулово","Дунавци","Дупница","Дългопол","Елена","Елин Пелин","Елхово","Етрополе","Завет","Земен","Златарица","Златица","Златоград","Ивайловград","Игнатиево","Искър","Исперих","Ихтиман","Каблешково","Каварна","Казанлък","Калофер","Камено","Каолиново","Карлово","Карнобат","Каспичан","Кермен","Килифарево","Китен","Клисура","Кнежа","Козлодуй","Койнаре","Копривщица","Костандово","Костенец","Костинброд","Котел","Кочериново","Кресна","Криводол","Кричим","Крумовград","Крън","Кубрат","Куклен","Кула","Кърджали","Кюстендил","Левски","Летница","Ловеч","Лозница","Лом","Луковит","Лъки","Любимец","Лясковец","Мадан","Маджарово","Малко Търново","Мартен","Мелник","Мездра","Меричлери","Мизия","Момин проход","Момчилград","Монтана","Мъглиж","Неделино","Несебър","Николаево","Никопол","Нова Загора","Нови Искър","Нови пазар","Обзор","Омуртаг","Опака","Оряхово","Павел баня","Павликени","Пазарджик","Панагюрище","Перник","Перущица","Петрич","Пещера","Пирдоп","Плачковци","Плевен","Плиска","Пловдив","Полски Тръмбеш","Поморие","Попово","Пордим","Правец","Приморско","Провадия","Първомай","Раднево","Радомир","Разград","Разлог","Ракитово","Раковски","Рила","Роман","Рудозем","Русе","Садово","Самоков","Сандански","Сапарева баня","Свети Влас","Свиленград","Свищов","Своге","Севлиево","Сеново","Септември","Силистра","Симеоновград","Симитли","Славяново","Сливен","Сливница","Сливо поле","Смолян","Смядово","Созопол","Сопот","София","Средец","Стамболийски","Стара Загора","Стражица","Стралджа","Стрелча","Суворово","Сунгурларе","Сухиндол","Съединение","Сърница","Твърдица","Тервел","Тетевен","Тополовград","Троян","Трън","Тръстеник","Трявна","Тутракан","Търговище","Угърчин","Хаджидимово","Харманли","Хасково","Хисаря","Цар Калоян","Царево","Чепеларе","Червен бряг","Черноморец","Чипровци","Чирпан","Шабла","Шивачево","Шипка","Шумен","Ябланица","Якоруда","Ямбол" ];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("start"), countries);
autocomplete(document.getElementById("end"), countries);
</script>
   

     <script>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
function initMap() {
		var alnevski = {lat: 42.695818, lng: 23.332930};
		var nim = {lat: 42.655101, lng: 23.270691};
		var zmostove = {lat: 42.609607, lng: 23.239042};
		var boqnskivod = {lat: 42.629528, lng: 23.254178};
		var kopito = {lat: 42.637128, lng: 23.243737};
		var kamendel = {lat: 42.612113, lng: 23.276757};
		var bankq = {lat: 42.701550, lng: 23.144877};
		var krakra = {lat: 42.594139, lng: 23.018017};
		
		  
		  
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 42.695818, lng: 25.332930}
        });
		  
		var nevskiinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Катедралният храм "Св. Ал. Невски"</h1><div id="bodyContent"><p><b>Катедралният храм "Св. Ал. Невски"</b> е считан за символ на българската столица. Намира се в центъра на София, на едноименния площад, а отблясъкът на златните му кубета привлича погледа от километри разстояние. Храмът е построен в чест на руския император Александър II, наричан още "Цар Освободител", чиято армия през 1878г освобождава България от петвековното османско владичество. Св. Александър Невски, чието име носи катедралата, е руски княз (1220-1263г) - велик пълководец и дипломат. Той е светец-покровител на руския император Александър II и е символ на руската бойна слава. Храмът е изграден по предложение на българския политик и общественик Петко Каравелов (1843-1903г). Първоначално е било решено той да бъде издигнат в Търново, но българският княз Батенберг (управлявал 1879-1886г) настоява да е в София. Една част от средствата за построяването на храма се отпускат от държавния бюджет, друга от дарения на видни граждани, включително и от княз Батенберг, който дарява сумата от 6000 златни лева.</p></div></div>';
	
		var niminf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Националният исторически музей</h1><div id="bodyContent"><p><b>Националният исторически музей</b> e eдин от най-големите и богати исторически музеи на Балканския полуостров. В него се съхраняват над 700 000 паметници на културата, представящи историята на днешните български земи отпреди 8000 години до наши дни. В залите на музея са изложени едва 10% от всички тези ценности и паметници. Националният исторически музей е създаден през 1973г.</p></div></div>';
		  
		var zmostoveinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Златни мостове</h1><div id="bodyContent"><p><b>Златни мостове</b> са може би най-посещаваната местност на Витоша. Още преди Втората световна война, когато не е имало път от София до тук, любителите на планината, с раници на гръб, идвали през почивните си дни по малките пътечки от Княжево, Бояна и Владая, за да се насладят на красивата природата. Днес м. Златни мостове (на 12 км от Бояна) е свързана със столицата с автомобилен път.</p></div></div>';
		  
		var boqnskivodinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Боянски водопад</h1><div id="bodyContent"><p><b>Боянски водопад</b> е името на водопад на Боянската река, намиращ се край град София на около 5км от центъра на кв. Бояна. Той е най-големият водопад на територията на планината Витоша. Водният пад е с височина около 20м. В ясни пролетни дни Боянският водопад може да бъде видян от центъра на София. По време на топенето на снеговете във високите части на Витоша той е най-пълноводен и буйните му пръски се различават сред гората.До водопада може са се стигне по три основни пътеки. Най-лесен е достъпът откъм "Копитото". В зависимост от темпото, разходката сред живописната природа трае около час - час и половина, като по-голямата част от пътеката е равна. По-труден е само последният участък, който води към водопада - неравен, каменист терен, който се спуска стръмно към водопада отгоре.</p></div></div>';
		  
		var kopitoinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Копитото</h1><div id="bodyContent"><p><b>Местността Копитото</b> е разположена на около 1350 метра надморска височина, в близост до София. Около емблематичната телевизионната кула се е образувал цял туристически комплекс с ресторанти, будки и магазинчета. Пеш до местността може да се стигне за час и половина - два, като се тръгне от кварталите "Княжево" или "Овча Купел". Също така може да се вземе градския транспорт или да се използва кабинковият лифт.</p></div></div>';
		  
		var kamendelinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Връх Камен дел</h1><div id="bodyContent"><p><b>Връх Камен дел</b>Един от върховете на Витоша планина е Камен дел, с височина 1862м. Лесно достъпен от Симеоновския лифт, като самото изкачване ще ви отнеме около 60-70мин. От върха се открива прекрасна гледка към София.</p></div></div>';

		var bankqinf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Пътека на здравето</h1><div id="bodyContent"><p><b>Пътека на здравето</b>Тази екопътека е напълно възстановена от Столична община – Район "Банкя", а проектът е реализиран с подкрепата на "Минерални води – Банкя". Пътеката е маркирана с указателни табели и стрелки по цялата си дължина, за да бъде достъпна както за местните жители, така и за гостите на град Банкя, които не познават добре региона. Маршрут "Пътека на здравето" - Изходна точка: гр. Банкя. Общо време на преход: около 2 часа. Денивелация: 50-60 метра. Дължина на маршрута: 6-7 километра. От центъра на града се тръгва към военния санаториум. Пътеката минава покрай десния бряг на Градоманската река, западната част на кв. Градоман, язовира на кв. Михайлово, началото на местността Купен дол, последвано от красива борова гора. Маршрутът пресича бившата теренна пътека и покрай Теневия баир се влиза в Старо село (старата част на Банкя), след което се стига и до църквата "Св. св. Кирик и Юлита". Пътеката се връща обратно по алтернативен маршрут до изходна точка.</p></div></div>';
		  

		  
		var krakrainf = '<div id="content"><h1 id="firstHeading" class="firstHeading">Крепостта Кракра</h1><div id="bodyContent"><p><b>Средновековната крепост Кракра</b> е разположена на неголямо скалисто плато в югозападната част на град Перник.Запазените останки очертават многоъгълна крепост, за която се смята, че е построена по времето на хан Омуртаг (814-831г). Крепостната стена е с дебелина 2 метра. Очертанията й следват естествените извивки на платото. Археолозите откриват останки, които показват, че крепост на това място е съществувала още през VІ–Vв пр.н.е. Историята й обаче е свързана най-вече с името на болярина Кракра Пернишки – български военачалник, живял през X-XI в. Той бил владетел на крепостта и селището Перник в началото на ХІв и на още 35 крепости в района. Пернишката крепост оказала решителна съпротива срещу византийското завоевание, устоява на две обсади (през 1004г и 1016г) и средновековният Перник не бил разрушен. От крепостта се открива изглед към местността Кървавото. Според легендата през 1016г. Кракра устоява на 88-дневна обсада, при която загиват много византийци. Тяхната кръв обагрила местността в червено и оттам дошло името й.</p></div></div>';
		  
		  
		var alnevskiwindows = new google.maps.InfoWindow({
			content: nevskiinf
		});
		var nimwindow = new google.maps.InfoWindow({
			content: niminf
		});
		var zmostovewindow = new google.maps.InfoWindow({
			content: zmostoveinf
		});
		var boqnskivodwindow = new google.maps.InfoWindow({
			content: boqnskivodinf
		});

		var bankqwindow = new google.maps.InfoWindow({
			content: bankqinf
		});
		var kopitowindow = new google.maps.InfoWindow({
			content: kopitoinf
		});
		var kamendelwindow = new google.maps.InfoWindow({
			content: kamendelinf
		});
		var krakrawindow = new google.maps.InfoWindow({
			content: krakrainf
		});

		  
		  
		  
		  
		  
		  
		if(document.getElementById("kultura").checked == true){
			var alnevskiwindows = new google.maps.InfoWindow({
				content: nevskiinf
			});
			var nimwindow = new google.maps.InfoWindow({
				content: niminf
			});
			var nevskimark = new google.maps.Marker({
				position: alnevski,
				map: map,
				title: 'Св. Александър Невски'
			});
			
			var nimmark = new google.maps.Marker({
				position: nim,
				map: map,
				title: 'Националният исторически музей'
			});
			nevskimark.addListener('click', function() {
				alnevskiwindows.open(map, nevskimark);
			});
			nimmark.addListener('click', function() {
				nimwindow.open(map, nimmark);
			});
		}
		if(document.getElementById("priroda").checked == true){	
			var zmostovewindow = new google.maps.InfoWindow({
				content: zmostoveinf
			});
			var boqnskivodwindow = new google.maps.InfoWindow({
				content: boqnskivodinf
			});
			var kopitowindow = new google.maps.InfoWindow({
				content: kopitoinf
			});
			var kamendelwindow = new google.maps.InfoWindow({
				content: kamendelinf
			});
			var zmostovemark = new google.maps.Marker({
				position: zmostove,
				map: map,
				title: 'Златните мостове'
			});
			var boqnskimark = new google.maps.Marker({
				position: boqnskivod,
				map: map,
				title: 'Боянски водопад'
			});
			var kopitomark = new google.maps.Marker({
				position: kopito,
				map: map,
				title: 'Копитото'
			});
			var kamendelmark = new google.maps.Marker({
				position: kamendel,
				map: map,
				title: 'Камен дел'
			});
			zmostovemark.addListener('click', function() {
				zmostovewindow.open(map, zmostovemark);
			});
			boqnskimark.addListener('click', function() {
				boqnskivodwindow.open(map, boqnskimark);
			});
			kopitomark.addListener('click', function() {
				kopitowindow.open(map, kopitomark);
			});
			kamendelmark.addListener('click', function() {
				kamendelwindow.open(map, kamendelmark);
			});
		}
		if(document.getElementById("eko").checked == true){	
			var bankqwindow = new google.maps.InfoWindow({
				content: bankqinf
			});
			var bankqmark = new google.maps.Marker({
				position: bankq,
				map: map,
				title: 'Пътека на здравето'
			});
			bankqmark.addListener('click', function() {
				bankqwindow.open(map, bankqmark);
			});
		}

		if(document.getElementById("istoria").checked == true){		
			var krakrawindow = new google.maps.InfoWindow({
				content: krakrainf
			});
			var krakramark = new google.maps.Marker
			({
				position: krakra,
				map: map,
				title: 'Крепостта Кракра'
			});	
			krakramark.addListener('click', function() {
				krakrawindow.open(map, krakramark);
			});
		}
		  
		  





		  
		  
		  
		  
		  
		  
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }

        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            document.getElementById('directions-panel').style.display="block";
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Част от пътя: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Този път не е достъпен' + status);
          }
        });
      }
		

    </script>
    
    
    
   
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Kmdzn2GQtXoF5PZSVdlBFdk5EPo5YKw&callback=initMap"
    async defer></script>
</body>
</html>