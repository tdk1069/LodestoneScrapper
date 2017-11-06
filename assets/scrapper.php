<?php
function scrap_ffxiv($url) {

	$html = file_get_html($url);
	$character->Name = $html->find('p.frame__chara__name',0)->plaintext;
	$character->Image = $html->find('div.character__detail__image',0)->find('img',0)->src;
	$character->FC = $html->find('div.character__freecompany__name',0)->find('a',0)->plaintext;
	$character->Server = $html->find('.frame__chara__world',0)->plaintext;
	$character->Title = $html->find('.frame__chara__title',0)->plaintext;
	$character->Race = $html->find('.character-block__name',0)->plaintext;
	$character->Nameday = $html->find('.character-block__birth',0)->plaintext;
	$character->Guardian = $html->find('.character-block__name',1)->plaintext;
	$character->City = $html->find('.character-block__name',2)->plaintext;
	$character->GC = $html->find('.character-block__name',3)->plaintext;
	$character->Introduction = $html->find('.character__selfintroduction',0)->plaintext;

	$character->HP = $html->find('.character__param__text__hp--en-gb',0)->next_sibling()->plaintext;
	if (is_object($html->find('.character__param__text__mp--en-gb',0)))
		$character->MP = $html->find('.character__param__text__mp--en-gb',0)->next_sibling()->plaintext;
	else
		$character->MP = 0;
	$character->TP = $html->find('.character__param__text__tp--en-gb',0)->next_sibling()->plaintext;

	$character->Strength = $html->find('.character__param__list',0)->find('td',0)->plaintext;
	$character->Dexterity = $html->find('.character__param__list',0)->find('td',1)->plaintext;
	$character->Vitality = $html->find('.character__param__list',0)->find('td',2)->plaintext;
	$character->Intelligence = $html->find('.character__param__list',0)->find('td',3)->plaintext;
	$character->Mind = $html->find('.character__param__list',0)->find('td',4)->plaintext;

	$character->Critical_Hit_Rate = $html->find('.character__param__list',1)->find('td',0)->plaintext;
	$character->Determination = $html->find('.character__param__list',1)->find('td',1)->plaintext;
	$character->Direct_Hit_Rate = $html->find('.character__param__list',1)->find('td',2)->plaintext;

	$character->Defense = $html->find('.character__param__list',2)->find('td',0)->plaintext;
	$character->Magic_Defense = $html->find('.character__param__list',2)->find('td',1)->plaintext;

	$character->Attack_Power = $html->find('.character__param__list',3)->find('td',0)->plaintext;
	$character->Skill_Speed = $html->find('.character__param__list',3)->find('td',1)->plaintext;

	$character->Attack_Magic_Potency = $html->find('.character__param__list',4)->find('td',0)->plaintext;
	$character->Healing_Magic_Potency = $html->find('.character__param__list',4)->find('td',1)->plaintext;
	$character->Spell_Speed = $html->find('.character__param__list',4)->find('td',2)->plaintext;

	$character->Tenacity = $html->find('.character__param__list',5)->find('td',0)->plaintext;
	$character->Piety = $html->find('.character__param__list',5)->find('td',1)->plaintext;

	$character->Fire = $html->find('.character__param__element',0)->find('li',0)->plaintext;
	$character->Ice = $html->find('.character__param__element',0)->find('li',1)->plaintext;
	$character->Wind = $html->find('.character__param__element',0)->find('li',2)->plaintext;
	$character->Earth = $html->find('.character__param__element',0)->find('li',3)->plaintext;
	$character->Lightning = $html->find('.character__param__element',0)->find('li',4)->plaintext;
	$character->Water = $html->find('.character__param__element',0)->find('li',5)->plaintext;

	$rows = $html->find('div[class=character__level__list]');
	$Jobs = 	array("GLA","MRD","DRK",
						"CNJ","SCH","AST",
						"PGL","LNC","ROG",
						"SAM","ACN","MCH",
						"THM","SMN","RDM",
						"CRP","BSM","ARM",
						"GSM","LTW","WVR",
						"ALC","CUL","MIN",
						"BTN","FSH");
	$classes = [];
	foreach($rows as $job){
		foreach($job->find('li') as $level)
		{
			array_push($classes,array($Jobs[0] => $level->plaintext));
			array_shift($Jobs);
		}
	}
	$character->classes = $classes;

	$mounts = $html->find('ul[class="character__icon__list"]')[0];
	$mounts_array = [];
	foreach($mounts->find('div') as $div)
		if ($div->attr['data-tooltip']) {array_push($mounts_array, array("Name" => $div->attr['data-tooltip'], "Image" => $div->find('img',0)->src));}
	$character->Mounts = $mounts_array;

	$minions = $html->find('ul[class="character__icon__list"]')[1];
	$minions_array = [];
	foreach($minions->find('div') as $div)
		if ($div->attr['data-tooltip']) {array_push($minions_array, array("Name" => $div->attr['data-tooltip'], "Image" => $div->find('img',0)->src));}
	$character->minions = $minions_array;
	$character->Now = time();
return json_encode($character);
}
?>
