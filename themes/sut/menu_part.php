<div class="navbar navbar-custom">
  <div class="container">
  <!--
    <div class="navbar-header">
      <a class="logo-header" href=".."><img src="img/logo.png" alt="Станция Юных Техников"></a>
      <a class="navbar-brand" href="..">"СТАНЦИЯ ЮНЫХ ТЕХНИКОВ"</a>
      <span class="title_down">Волгодонск</span>
    </div>
-->
    <div class="nav menu-block">
    
	<!--
      <ul class="nav nav-pills navbar-right menu-block">
        <li>
          <a href=".." title="Станция Юных Техников">
            <i class="glyphicon glyphicon-home"></i>
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Основное меню">Основное меню</a>
          <ul id="menu_main" class="dropdown-menu" role="menu"> </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Сведения об организации">Сведения об организации</a>
          <ul id="menu_info" class="dropdown-menu" role="menu"> </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Противодействие коррупции">Противодействие коррупции</a>
          <ul id="menu_anticorruption" class="dropdown-menu" role="menu"> </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Статьи">Статьи <span id="count" class="badge">0</span> <span class="caret"></span></a>
          <ul id="menu" class="dropdown-menu" role="menu"> </ul>
        </li>
      </ul>
	  -->
	  <ul class="menu h">


		  <!--
<li><a href="/">Главная</a></li>

<li><a href="#">О нас</a>
            <ul >
            <li><a href="/history.html">Наша история</a>
			
			</li>
            <li><a href="/activities.html">Деятельность</a></li>
            <li><a href="/info_administration.html">Администрация и педагогический состав (Обработка персональных данных осуществляется с согласия субъектов персональных данных на обработку его персональных данных)</a></li>
            <li><a href="/sites_teachers.html">Сайты педагогов</a></li>
            <li><a href="/contacts.html">Контакты</a></li>
			</ul>
</li>

<li><a href="#">Структурные подразделения</a>
<ul ><li><a href="#">Клуб авиатехнического творчества «Фобос» </a>
			<ul >
				<li><a href="/phobos_info.html">Информация о клубе</a></li>
				<li><a href="/phobos_timetable.html">Расписание занятий</a></li>
				<li><a href="/phobos_educators.html">Педагоги</a></li>
				<li><a href="/phobos_news.html">Новости клуба</a></li>
				<li><a href="/phobos_safe_way.html">Безопасный путь</a></li>
			</ul>			
			</li>
            <li><a href="#">Клуб спортивно-технического автомоделирования «Глобус» </a>
			<ul >
				<li><a href="/globus_info.html">Информация о клубе</a></li>
				<li><a href="/globus_timetable.html">Расписание занятий</a></li>
				<li><a href="/globus_educators.html">Педагоги</a></li>
				<li><a href="/globus_news.html">Новости клуба</a></li>
				<li><a href="/globus_safe_way.html">Безопасный путь</a></li>
			</ul></li>
            <li><a href="#">Детский компьютерный центр «Дебют»  </a>
			<ul >
				<li><a href="/debut_info.html">Информация о клубе</a></li>
				<li><a href="/debut_timetable.html">Расписание занятий</a></li>
				<li><a href="/debut_educators.html">Педагоги</a></li>
				<li><a href="/debut_news.html">Новости клуба</a></li>
				<li><a href="/debut_safe_way.html">Безопасный путь</a></li>
			</ul></li>
            <li><a href="#">Фототехнический клуб</a>
			<ul >
				<li><a href="/phototechnical_club_info.html">Информация о клубе</a></li>
				<li><a href="/phototechnical_club_timetable.html">Расписание занятий</a></li>
				<li><a href="/phototechnical_club_educators.html">Педагоги</a></li>
				<li><a href="/phototechnical_club_news.html">Новости клуба</a></li>
				<li><a href="/phototechnical_club_safe_way.html">Безопасный путь</a></li>
			</ul></li>
            <li><a href="#">Учебно-тренировочный комплекс</a>
			<ul >
				<li><a href="/training_complex_info.html">Информация о клубе</a></li>
				<li><a href="/training_complex_timetable.html">Расписание занятий</a></li>
				<li><a href="/training_complex_educators.html">Педагоги</a></li>
				<li><a href="/training_complex_news.html">Новости клуба</a></li>
				<li><a href="/training_complex_safe_way.html">Безопасный путь</a></li>
			</ul>
			</li>
			</ul >
</li>
<li><a href="#">Объединения</a>
<ul >
				<li><a href="/technical_direction.html">Техническая направленность</a></li>
				<li><a href="/natural_science_direction.html">Естественнонаучная направленность</a></li>
				<li><a href="/sociopedagogical_direction.html">Социально-педагогическая направленность</a></li>
				<li><a href="/sport_direction.html">Физкультурно-спортивная направленность</a></li>
				<li><a href="/art_direction.html">Художественная направленность</a></li>
			</ul>
</li>
<li><a href="/reception.html">Электронная приемная</a></li>
-->
		  <?=$MENUS->view(1)?>
</ul>
<div id="find">
	<form action="/index.php" method="get">
		<input type="text"   name ="keyword" value="" />
		<input type="hidden" name ="action" value="find" />
		<input type="hidden" name ="module" value="articles" />
		<input type="submit" value = "Найти"  />

	</form>
</div>
<div id="soclink">
<a href="https://www.instagram.com/sutvdonsk/" target="_blank" class="fa fa-instagram" title="Мы Instagram"></a>
<a href="https://vk.com/sutvdonsk" target="_blank" class="fa fa-vk" title="Мы ВКонтакте"></a>
<a href="https://twitter.com/sut_vdonsk" target="_blank" class="fa fa-twitter" title="Мы в Twitter"></a>
<a href="https://www.youtube.com/ТелестудияСЮТ" target="_blank" class="fa fa-youtube"  title="Мы в Youtube"></a>
<a href="https://www.facebook.com/groups/sutvdonsk/" target="_blank" class="fa fa-facebook-square"  title="Мы в FaceBook"></a>
<a href="https://www.ok.ru/group/53957294948604 " target="_blank" class="fa fa-odnoklassniki-square"  title="Мы в Одноклассниках"></a>
</div>
	  
	  
    
    </div>
  </div>
</div>
