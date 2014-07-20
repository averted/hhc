<?php

require __DIR__.'/autoload.php';

use hhc\DB\Hero;
use hhc\DB\HeroQuery;

// grab all api.hon.com heroes
$url = "http://api.heroesofnewerth.com/heroes/all?token=" . API_TOKEN;

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
    foreach ($hero_json as $h) {
        $hq = HeroQuery::create()->filterByHeroID($h['hero_id'])->findOne();

        // hero not found in db, create new
        if (!$hq) {
            $hero = new Hero();
            $hero->setHeroID($h['hero_id']);
            $hero->setName(trim($h['disp_name']));
            $hero->setStat($h['primaryattribute']);
            $hero->setAttackType($h['attacktype']);
            $hero->setTeam($h['team']);
            $hero->setSlug(strtolower(str_replace('-', '', str_replace(' ', '', trim($h['disp_name'])))));
            $hero->save();
        }
    }
    echo "API: Heroes loaded\n";
} else {
    echo "Too many requests\n";
}

?>
