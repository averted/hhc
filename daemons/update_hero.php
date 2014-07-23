<?php

require dirname(__DIR__).'/autoload.php';

use hhc\DB\Hero;
use hhc\DB\HeroQuery;

// find all heroes with missing details
$hq = HeroQuery::create()->where('dmgmin IS NULL')->find();

foreach ($hq as $empty_hero) {
    // grab hero details
    $url = "http://api.heroesofnewerth.com/heroes/id/{$empty_hero->getHeroID()}/?token=" . API_TOKEN;

    // curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    $result = curl_exec($curl);
    curl_close($curl);

    // decode
    $hero_json = json_decode($result, true);

    if ($hero_json) {
        $hero = HeroQuery::create()->filterByHeroID($empty_hero->getHeroID())->findOne();

        $hero->setRole($hero_json['attributes']['CATEGORY']);
        $hero->setAttackRange(intval($hero_json['info']['ATTACKRANGE']));
        $hero->setAttackSpeed($hero_json['info']['ATTACKSPEEDPERSEC']);
        $hero->setHP($hero_json['attributes']['HEALTH']);
        $hero->setMana($hero_json['attributes']['MANA']);
        $hero->setDmg($hero_json['info']['DAMAGE']);
        $hero->setDmgMin($hero_json['attributes']['ATTACKDAMAGEMIN']);
        $hero->setDmgMax($hero_json['attributes']['ATTACKDAMAGEMAX']);
        $hero->setArmor(floatval($hero_json['info']['CALCARMOR']));
        $hero->setMagicArmor(floatval($hero_json['info']['MAGICARMOR']));
        $hero->setStrength(intval($hero_json['info']['STRENGTH']));
        $hero->setStrperlvl(floatval($hero_json['info']['STRENGTHPERLEVEL']));
        $hero->setAgility(intval($hero_json['info']['AGILITY']));
        $hero->setAgiperlvl(floatval($hero_json['info']['AGILITYPERLEVEL']));
        $hero->setIntelligence(intval($hero_json['info']['INTELLIGENCE']));
        $hero->setIntperlvl(floatval($hero_json['info']['INTELLIGENCEPERLEVEL']));
        $hero->setHpRegen(floatval($hero_json['attributes']['HEALTHREGEN']));
        $hero->setManaRegen(floatval($hero_json['attributes']['MANAREGEN']));
        $hero->setMoveSpeed(intval($hero_json['info']['MOVESPEED']));
        $hero->save();

        echo "API: Hero {$hero->getHeroID()} details loaded\n";
    } else {
        echo "Too many requests\n";
    }
}

?>
