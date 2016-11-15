
<!DOCTYPE html>
<html>
	<head>
		<title>
			Recherche
		</title>
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
		<script type="text/javascript" src="JQuery/slideshow.js"></script>
		<script src="jQuery/jquery.rwdImageMaps.min.js"></script>
		<script src="jQuery/compteAR.js"></script>
		<script type="text/javascript">
			var area='';

			function translateMenu(){
				//fait glisser vers le menu suivant
				var size=$('#menu_principal').width();
				$('#cat_container').css({
					'transform':'translate(-'+size+'px )',
					'transition':'2s'
				});
			};
			
			function envoieRecherche(index){
					window.location.replace("musique.php?cat="+index+"+area="+area+"");
			};

		</script>
		<link rel="icon" type="image/png" href="yourImage.png" />
		<meta charset="UTF-8"/>
		<meta name="keywords" content="">
		<meta name="description" content="">
	</head>
	<body onload="appel()">
		<header>
			<nav id="menu_top">
				<ul>
					
					<li>
						<a href="index.php">
							Discover
						</a>
					</li>
					<li>
						<a href=#>
							About us
						</a>
					</li>
					<li>
						Language
						<select id="lang">
							<option class="icone1"></option>
							<option class="icone2"></option>
						</select>
					</li>
                    
					<li>
                    <?php 
                            session_start();
                            if (isset($_POST["valid"])){
                                if(isset($_POST['login'])){
                                    $login=$_POST['login'];
                                }
                                if(isset($_POST['pass'])){
                                    $pass=$_POST['pass'];
                                }
                                if(empty($pass)||empty($login)){
                                    echo "<div id='mess' style='z-index:5;position:fixe'>remplir login/pass</div>
                                        <li>
                                            <form method='POST'>
						                            Loggin <input type='text' id='form_log' placeholder='Your Loggin' name='login'/>
					                            </li>
					                            <li>
						                            Password <input type='password' id='form_pwd' name='pass'/>
					                            </li>
					                            <li>
						                            <input type='submit' id='submit_log' value='Go' name='valid'/>
                                            </form>
					                    </li>";
                                }elseif ($login=="Login" && $pass=="pass"){
                                    echo '<li><a href="monCompte.php">Mon compte</a></li>
                                    <li><a href="deco.php">Se deco</a></li>';
                                }else{
                                    echo "<div id='mess' style='z-index:5;position:fixe'>mauvais login/pass</div>
                                            <li>
                                                <form method='POST'>
						                                Loggin <input type='text' id='form_log' placeholder='Your Loggin' name='login'/>
					                                </li>
					                                <li>
						                                Password <input type='password' id='form_pwd' name='pass'/>
					                                </li>
					                                <li>
						                                <input type='submit' id='submit_log' value='Go' name='valid'/>
                                            </form>
					                    </li>";
                                }
                                
                            }else{ ?>
                        
                    <form method="POST">
						Loggin <input type="text" id="form_log" placeholder="Your Loggin" name="login"/>
					</li>
					<li>
						Password <input type="password" id="form_pwd" name="pass"/>
					</li>
					<li>
						<input type="submit"id="submit_log" value="Go" name="valid"/>
                    </form>
					</li> <?php } ?>
                    </li>
				</ul>
			</nav>
		</header>
		<ul id="diaporama">
			<li>
				<img src="img/new-york-at-night.jpg"/>
			</li>
			<li>
				<img src="http://voyagerloin.com/vl-content/2014/01/1920x1080-1.jpg"/>
			</li>
			<li>
				<img src="http://img0.svstatic.com/wallpapers/bc00074907635b70b76adce6361ef2fd_large.jpeg"/>
			</li>
			<li>
				<img src="http://wallpapers111.com/wp-content/uploads/2015/02/Peru-HD-Wallpaper1.jpg"/>
			</li>
			<li>
				<img src="http://fr.wallpaperswiki.org/wallpapers/2012/10/Pyramides-du-Caire-de-la-bande-de-Gaza-900x1600.jpg"/>
			</li>
		</ul>
		<section id="dateConcert">
				<p>Concert begins in:<span id="decompte"></span></p> 
		</section>
		<section id="menu_principal">
			<ul id="cat_container">
				<li>
					<div class="map">
					<div class="tooltip"></div>
						<img src="img/worldmap.png" width="1425" height="625" usemap="#Map" />
						<map name="Map">
							<area shape="poly" coords="344,271,344,274,347,283,340,283,327,281,332,275,339,270" href="#">
							<area shape="poly" coords="174,215,184,215,194,221,207,221,213,219,220,225,224,231,232,228,236,236,241,245,245,243,248,236,257,232,266,227,276,230,281,230,284,225,292,225,302,226,306,231,306,240,309,247,314,246,314,239,314,229,315,221,325,213,332,208,341,198,345,189,358,180,367,175,374,170,386,161,390,160,390,151,380,152,372,159,360,160,345,168,330,175,326,171,330,166,330,159,323,151,308,148,296,142,242,142,195,143,185,133,179,138,184,145,181,154,172,164,165,176,162,185,163,202" href="#">
							<area shape="poly" coords="634,168,640,171,644,168,648,171,653,170,657,168,664,169,666,164,666,158,663,155,667,150,670,143,660,141,653,136,649,134,644,140,639,142,632,144,627,145,628,149,635,151,637,157" href="#">
							<area shape="poly" coords="755,129,763,129,770,136,782,139,788,143,783,148,783,155,779,158,782,163,791,167,799,168,817,174,825,176,820,169,816,163,822,157,823,152,812,145,813,138,818,138,824,132,834,133,858,137,862,134,859,126,863,121,882,116,891,119,905,123,911,121,920,127,928,135,941,136,952,140,959,142,967,139,980,135,991,139,998,138,994,133,1000,130,1014,135,1027,138,1035,140,1056,140,1069,140,1072,133,1068,126,1076,123,1091,127,1103,139,1113,144,1125,150,1135,147,1137,153,1135,160,1134,167,1136,173,1146,170,1151,157,1153,142,1142,127,1132,120,1122,121,1115,118,1119,106,1126,99,1142,99,1157,100,1160,89,1171,92,1177,91,1178,86,1183,91,1182,100,1180,108,1186,119,1199,130,1206,134,1205,119,1201,107,1190,99,1203,94,1211,95,1218,87,1226,86,1207,77,1216,76,1213,71,1226,75,1238,78,1231,68,1214,66,1196,62,1164,56,1162,62,1144,57,1124,56,1109,53,1093,52,1057,47,1053,53,1041,51,1032,54,1019,46,998,46,971,43,960,45,964,38,958,33,931,29,909,35,895,37,876,49,866,50,852,46,845,54,848,61,834,58,817,61,802,62,785,64,778,71,766,76,759,79,751,69,766,70,774,66,762,61,745,58,738,57,736,64,741,76,745,86,739,95,738,102,740,114,750,115,754,121" href="#">
							<area shape="poly" coords="1065,145,1069,142,1074,140,1074,132,1074,126,1084,129,1092,133,1102,142,1113,148,1123,152,1131,151,1134,156,1129,163,1132,170,1125,176,1117,183,1112,187,1106,179,1100,184,1094,188,1098,193,1105,196,1111,193,1117,196,1109,204,1109,208,1116,216,1122,223,1121,228,1126,230,1124,240,1114,259,1104,261,1098,261,1090,267,1086,271,1079,266,1070,262,1062,260,1052,264,1044,267,1035,254,1036,245,1028,235,1012,232,1007,240,1000,235,993,238,979,232,959,225,951,216,948,203,932,197,924,186,937,178,945,169,941,162,950,152,954,149,961,144,971,149,979,157,991,162,1002,167,1008,172,1028,174,1055,171,1060,167,1059,160,1066,160,1075,155,1083,153" href="#">
							<area shape="poly" coords="307,146,320,145,329,147,329,155,339,157,341,163,332,168,332,172,341,169,349,164,358,160,368,158,375,155,386,149,393,153,392,160,395,167,406,165,415,159,409,155,404,149,409,141,422,139,424,146,430,152,446,149,448,141,442,134,447,127,444,120,437,118,433,102,430,92,418,100,413,90,400,86,387,90,375,113,360,126,355,116,334,106,332,96,353,85,367,82,383,82,395,82,407,81,419,87,426,90,440,83,454,65,435,47,423,44,440,34,462,24,484,18,493,9,445,12,397,17,379,36,361,40,347,49,334,36,313,38,285,46,272,57,243,55,220,55,198,78,181,92,183,100,194,106,192,116,186,122,189,135,196,142,240,141,269,141,289,141,299,141" href="#">
							<area shape="poly" coords="411,496,417,504,429,510,439,501,443,484,441,478,460,466,469,464,477,438,477,424,486,412,493,396,489,386,477,383,467,374,452,376,449,369,438,366,426,361,423,348,415,352,394,354,386,354,388,343,377,341,366,345,368,357,359,356,351,354,346,361,345,375,346,382,337,384,330,394,335,406,349,413,359,410,363,407,369,417,380,422,388,431,398,438,402,449,402,462,419,472,423,480" href="#">
							<area shape="poly" coords="598,242,645,277,656,277,677,259,679,255,670,248,670,237,669,222,661,212,665,200,652,197,631,201,626,208,625,219,613,223,599,232" href="#">
							<area shape="poly" coords="916,257,926,255,923,247,919,240,929,234,935,224,936,217,929,209,938,205,944,205,948,215,952,224,958,229,960,238,978,243,992,246,994,241,1003,244,1011,239,1021,235,1028,240,1022,250,1016,261,1011,252,1001,249,996,253,1000,263,993,269,983,279,972,291,966,300,966,318,960,326,952,318,941,288,935,272,934,264,925,269" href="#">
							<area shape="poly" coords="686,215,679,224,679,233,680,245,682,250,688,255,693,259,706,261,724,270,735,275,738,268,738,241,738,221,723,215,716,224,701,220" href="#">
							<area shape="poly" coords="740,221,740,264,776,265,783,259,768,232,778,237,770,223" href="#">
							<area shape="poly" coords="687,390,699,384,709,367,713,356,716,343,730,345,746,340,753,344,763,345,767,353,761,363,760,371,758,379,759,390,763,401,755,406,756,418,760,424,739,416,729,411,724,393,711,401,705,392" href="#">
							<area shape="poly" coords="780,231,789,228,793,219,806,222,817,230,825,233,833,235,838,244,841,251,846,254,848,260,860,263,865,269,857,277,845,279,832,284,824,287,813,286,801,273,795,257,781,241" href="#">
							<area shape="poly" coords="735,278,735,293,730,300,730,308,734,318,736,323,742,318,746,323,756,320,762,315,769,319,772,308,779,316,788,303,786,291,793,283,788,270,784,263,772,269,754,267,743,267" href="#">
							<area shape="poly" coords="363,465,377,465,381,462,395,472,403,477,402,484,410,489,417,483,408,504,408,518,417,529,411,538,400,539,400,547,392,548,397,559,396,572,399,584,393,595,382,591,378,581,370,557,364,537,364,523,358,499" href="#">
							<area shape="poly" coords="175,218,184,218,191,224,201,225,211,224,216,226,221,232,228,234,232,234,237,245,245,249,241,258,242,271,248,279,261,280,269,269,279,266,279,275,270,280,259,287,255,294,245,288,235,292,216,282,207,275,205,259,194,241,186,230,186,243,190,259,175,240" href="#">
							<area shape="poly" coords="825,150,837,152,840,160,830,162,837,172,849,171,852,158,870,162,884,165,894,174,900,177,916,171,930,169,941,169,937,163,945,152,954,144,942,139,926,136,912,124,906,125,893,122,881,119,870,122,864,127,865,137,849,139,830,133,822,136,816,142" href="#">
							<area shape="poly" coords="1093,518,1100,504,1098,486,1101,468,1121,457,1133,455,1139,445,1148,437,1161,428,1170,432,1175,424,1185,419,1200,418,1203,424,1198,432,1209,442,1218,443,1220,432,1224,419,1229,416,1234,428,1239,446,1245,458,1256,478,1257,490,1244,512,1228,527,1213,537,1208,553,1193,563,1189,552,1193,543,1187,538,1182,527,1175,521,1165,512,1153,509,1123,518,1102,523" href="#">
							<area shape="poly" coords="461,32,483,34,490,44,494,53,491,61,484,70,483,84,489,94,500,95,510,86,516,76,533,73,546,66,563,63,579,59,585,53,590,41,597,32,602,22,617,20,618,13,595,12,571,11,534,16,506,15,477,24,463,27" href="#">
							<area shape="poly" coords="829,189,822,185,813,186,810,189,815,200,820,207,823,215,829,221,833,228,839,228,843,235,848,241,856,244,863,244,868,242,872,248,881,251,890,250,891,242,887,234,882,230,881,224,876,213,878,201,870,196,855,193,848,199,841,201,831,195" href="#">
							<area shape="poly" coords="307,356,323,365,332,373,341,375,341,367,342,358,347,352,354,352,353,342,352,335,339,333,332,324,333,316,340,309,337,304,325,316,315,326,310,334,314,345" href="#">
							<area shape="poly" coords="610,166,607,172,616,175,616,182,613,189,610,197,623,200,636,194,639,187,643,181,653,175,643,175,638,172,631,168,622,168" href="#">
						</map>
					</div>
				</li>
				<li>
					<ul id="categorie" >
						<a href="javascript:envoieRecherche(1)">
							<li class="menu_margin_right">
								<img src="img/musique.png"/>
								<p>
									Discover musics from everywhere around the world. 
								</p>
							</li>
						</a>
						<a href="javascript:translateMenu(2)">
							<li class="menu_margin_right">
								<img src="img/dance.png"/>
								<p>
									Discover dances and rythms from everywhere around the world.
								</p>
							</li>
						</a>
						<a href="javascript:translateMenu(3)">
							<li class="menu_margin_right">
								<img src="img/photo.png"/>
								<p>
									Galery of the World. Watch the world from locals people's eye.
								</p>
							</li>
						</a>
						<a href="javascript:translateMenu(4)">
							<li class="menu_margin_right">
								<img src="img/peinture.png"/>
								<p>
									Rich painting from any cultures, discover every sources of Art.
								</p>
							</li>
						</a>
						<a href="javascript:translateMenu(5)">
							<li>
								<img src="img/poterie.png"/>
								<p>
									Looking for nice and exotic sculptures? Artists from everywhere around the world are exposing their creations.
								</p>
							</li>
						</a>
					</li>
				</ul>
		</section>
		<script>
		$(document).ready(function(e) {
			//préparation de la map
			// tableau contenant les informations de chaque zone
			var zones=[
				{content:'Haiti<br/><img src="img/flags/FLAG-Haiti.gif"/>'},
				{content:'USA<br/><img src="img/flags/FLAG-USA.png"/>'},
				{content:'France<br/><img src="img/flags/FLAG-France.gif"/>'},
				{content:'Russia<br/><img src="img/flags/FLAG-Russie.png"/>'},
				{content:'China<br/><img src="img/flags/FLAG-Chine.gif"/>'},
				{content:'Canada<br/><img src="img/flags/FLAG-Canada.png"/>'},
				{content:'Brasil<br/><img src="img/flags/FLAG-Bresil.jpeg"/>'},
				{content:'Algeria<br/><img src="img/flags/FLAG-Algerie.png"/>'},
				{content:'India<br/><img src="img/flags/FLAG-Inde.png"/>'},
				{content:'Lybia<br/><img src="img/flags/FLAG-Lybie.png"/>'},
				{content:'Egypt<br/><img src="img/flags/FLAG-Egypte.png"/>'},
				{content:'Rep.Dem.Congo<br/><img src="img/flags/FLAG-RepDemCongo.png"/>'},
				{content:'Arabie Saoudite<br/><img src="img/flags/FLAG-ArabieSaoudite.png"/>'},
				{content:'Soudan<br/><img src="img/flags/FLAG-Soudan.png"/>'},
				{content:'Argentina<br/><img src="img/flags/FLAG-Argentine.jpeg"/>'},
				{content:'Mexico<br/><img src="img/flags/FLAG-Mexique.jpeg"/>'},
				{content:'Kazakstan<br/><img src="img/flags/FLAG-Kazakstan.png"/>'},
				{content:'Australia<br/><img src="img/flags/FLAG-Australie.png"/>'},
				{content:'Greenland<br/><img src="img/flags/FLAG-Groenland.png"/>'},
				{content:'Iran<br/><img src="img/flags/FLAG-Iran.png"/>'},
				{content:'Colombia<br/><img src="img/flags/FLAG-Colombie.jpeg"/>'},
				{content:'Spain<br/><img src="img/flags/FLAG-Espagne.jpeg"/>'}
				
			];
			//cache le tooltip
			$('.map .tooltip').hide();
			//redimensionne la taille des zones
			$('img[usemap]').rwdImageMaps();
			// action au lors d'un clique sur la carte
			$('area').on('click', function() {
				var index=$(this).index();
				area=index;
				translateMenu();
				
			});
			// survol d'une zone de la carte
			$('.map area').mouseover(function(){
				var index=$(this).index();
				$('.map .tooltip').html(zones[index].content);
				$('.map .tooltip').stop().fadeTo(0,1);
			});

			//efface la zone quand la souris en sort
			$('.map').mouseout(function(){
				$('.map .tooltip').stop().fadeTo(200,0);
			});
			
			// Positionne le tooltip en fonction de la souris
			$(document).mousemove(function(e){
				$('.map .tooltip').css({
					top:e.pageY-$('.map .tooltip').height()-30,
					left:e.pageX-$('.map .tooltip').width()/2-10
				})
			});
			
		});
	</script>
	</body>
</html>