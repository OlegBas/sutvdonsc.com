<div class="main_block_left">
  
  <!--
  <ul class="nav nav-pills nav-stacked" id="menu_left">
    <li class="special_version_thumbler" id="special_version_thumbler"><a href="#">Версия для слабовидящих</a></li>
  </ul>
  -->

  <ul class="nav nav-pills nav-stacked" >
    <li class="special_version_thumbler" id="special_version_thumbler"><a href="#">Версия для слабовидящих</a></li>
  </ul>
  <ul class="menu v">
	  <?=$MENUS->view(2);?>
    <!--<li><a href="#">Сведения об образовательной организации</a>
		<ul > 
			<li ><a href="/info_main_info.html">Основные сведения</a></li>
			<li ><a href="/info_structure.html">Структура и органы управления образовательной организацией</a></li>
			<li ><a href="/info_docs.html">Документы</a></li>
			<li ><a href="/info_education.html">Образование</a></li>
			<li ><a href="/info_education_standart.html">Образовательные стандарты</a></li>
			<li ><a href="/info_administration.html">Руководство. Педагогический состав</a></li>
			<li ><a href="/info_material_support.html">Материально-техническое обеспечение и оснащенность образовательного процесса</a></li>
			<li ><a href="/info_grants.html">Стипендии и иные виды материальной поддержки</a></li>
			<li ><a href="/info_paid_educational_services.html">Платные образовательные услуги</a></li>
			<li ><a href="/info_financial_economic_activity.html">Финансово-хозяйственная деятельность</a></li>
			<li ><a href="/info_vacancies.html">Вакантные места для приема (перевода)</a></li>
		</ul>
	</li>

    <li><a href="/news.html">Новости</a>
    </li>

    <li><a href="/plan_events.html">План мероприятий</a></li>
    <li><a href="/timetable.html">Расписание занятий</a>
    </li>
    <li><a href="/methodical_service.html">Методическая служба</a></li>
    <li><a href="/psychological_service.html">Психологическая служба</a></li>
    <li><a href="/innovation_activity.html">Инновационная деятельность</a></li>
    <li><a href="#">Наши проекты</a>
	<ul >
				<li><a href="/our_projects_ayui.html">АЮИ</a></li>
				<li><a href="/our_projects_dta.html">ДТА</a></li>
				<li><a href="/our_projects_cgk.html">ЧГК</a></li>
	
	</ul>
	</li>
	
	<li><a href="#">В помощь родителям</a>
	<ul >
				<li><a href="/regulation_admission_school.html">Положение о порядке приема в школу</a></li>
				<li><a href="/rules_information_educational_programs.html">Регламент о предоставлении информации по образовательным программам</a></li>
				<li><a href="/for_parents_statement.html">Заявление о зачислении</a></li>
				<li><a href="/additional_information_application_admission.html">Дополнительная информация к заявлению о зачислении</a></li>
				<li><a href="/reminders_for_parents.html">Памятки для родителей</a></li>
	
	</ul>
	</li>
	<li><a href="#">Противодействие коррупции </a>
	<ul >
	<li><a href="/anti_corruption_normative_legal_acts.html">Нормативные правовые и иные акты в сфере противодействия коррупции</a></li>
	<li><a href="/anti_corruption_examination.html">Антикоррупционная экспертиза</a></li>
	<li><a href="/anti_corruption_monitoring.html">Антикоррупционный мониторинг</a></li>
	<li><a href="/anti_corruption_methodical_materials.html">Методические материалы</a></li>
	<li><a href="/anti_corruption_forms_of_documents.html">Формы документов, связанных с противодействием коррупции, для заполнения</a></li>
	<li><a href="/anti_corruption_information_about_income_expenditure.html">Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера</a></li>
	<li><a href="/anti_corruption_commission_for_the_settlement.html">Комиссия по соблюдению требований к служебному поведению и урегулированию конфликта интересов (аттестационная комиссия)</a></li>
	<li><a href="/anti_corruption_commission_for_the_prevention.html">Комиссия по противодействию коррупции</a></li>
	<li><a href="/anti_corruption_news.html">Новости по противодействию коррупции</a></li>
	<li><a href="/anti_corruption_feedback.html">Обратная связь для сообщений о фактах коррупции</a></li>
	
	</ul>
	
	</li>
	<li><a href="/sponsors_and_partners.html">Спонсоры и социальные партнеры учреждения</a></li>
	<li><a href="#">Безопасность</a>
	<ul >
				<li><a href="/safe_way.html">Безопасный путь </a></li>
				<li><a href="/security_children.html">Детям</a></li>
				<li><a href="/reminders_for_parent2.html">Памятки для родителей</a></li>
				<li><a href="/occupational_safety.html">Охрана труда</a></li>
				<li><a href="/gocs.html">ГОЧС</a></li>
	
	</ul>
	
	
	</li>
	<li><a href="/mass_media_about_us.html">СМИ о нас</a></li>
	<li><a href="#">Медиатека</a>
	<ul >
				<li><a href="/media_library_magazine.html">Журнал «Твори! Выдумывай! Пробуй!»</a></li>
				<li><a href="/videos.html">Видеоролики</a></li>

				<li><a href="/photos.html">фото</a></li>
											
	
	</ul>
	</li>
-->
</ul>

  <hr>
	<h4>Наши достижения</h4>

	<h5>Учреждение</h5>
	<?
	print $SLIDERS->view(8, "mini_slide");
	?>
	<h5>Педагоги</h5>
	<?
	print $SLIDERS->view(9, "mini_slide");
	?>
	<h5>Учащиеся</h5>
	<?
	print $SLIDERS->view(10, "mini_slide");
	?>
	<hr>
<div style="text-align: center">

	<!--<script type="text/javascript" language="javascript" src="//баннер.сетевичок.рф/index.php?option=com_adagency&controller=adagencyAds&task=remote_ad&tmpl=component&format=raw&zid=119"></script>-->
</div>
</div>
