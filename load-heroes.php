<?php

use hhc\DB\Hero;
use hhc\DB\HeroQuery;
use hhc\DB\User;
use hhc\DB\UserQuery;
use hhc\DB\Votes;
use hhc\DB\VotesQuery;

/**
 * empty all tables to prevent duplicates
 */
$q = Propel::getConnection();
$q->exec('truncate hero');
$q->exec('truncate user');
$q->exec('truncate votes');
$q->exec('truncate user_votes');

/**
 * -------------------------------
 * populate [votes] table with test data
 * -------------------------------
 */
$votes = new Votes();
$votes->setHeroName('Aluna');
$votes->setCounterName('Maliken');
$votes->setVotes(58);
$votes->save();
$votes = new Votes();
$votes->setHeroName('Aluna');
$votes->setCounterName('Oogie');
$votes->setVotes(22);
$votes->save();
/**
 * -------------------------------
 * populate [user] table with test data
 * -------------------------------
 */
$user = new User();
$user->setUsername('something');
$user->setPassword('something');
$user->setEmail('email@email.com');
$user->save();

/**
 * -------------------------------
 * populate [hero] table
 * -------------------------------
 */
$hero = new Hero();
$hero->setAll('Aluna','Magic',454,16,22,18,600,300,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('Oogie','Magic Tank',586,22,23,15,128,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Maliken','Tank Physical',606,24,17,20,128,300,4); $hero->save();
$hero = new Hero();
$hero->setAll('Lodestone','CC Tank',625,25,15,17,128,290,4); $hero->save();
$hero = new Hero();
$hero->setAll('Accursed','Tank Protective',587,23,21,17,128,300,2); $hero->save();
$hero = new Hero();
$hero->setAll('Andromeda','CC',473,17,16,26,400,295,3); $hero->save();
$hero = new Hero();
$hero->setAll('Artillery','Physical',492,18,13,24,450,295,2); $hero->save();
$hero = new Hero();
$hero->setAll('Blitz','Magic CC',473,17,18,22,450,330,4); $hero->save();
$hero = new Hero();
$hero->setAll('Draconis','Physical Magic',492,18,17,23,600,300,2); $hero->save();
$hero = new Hero();
$hero->setAll('Emerald Warden','Physical Magic',430,17,18,22,625,290,2); $hero->save();
$hero = new Hero();
$hero->setAll('Engineer','CC Magic',530,20,21,20,500,295,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('Magebane','Physical',454,16,15,22,128,315,2); $hero->save();
$hero = new Hero();
$hero->setAll('Master of Arms','Magic CC',473,17,18,22,550,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Monkey King', 'Physical',492,18,17,19,128,305,5); $hero->save();
$hero = new Hero();
$hero->setAll('Night Hound','Physical',473,17,16,24,128,305,2); $hero->save();
$hero = new Hero();
$hero->setAll('Nomad','Physical',492,18,20,22,128,310,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('Scout','Physical',530,20,16,21,128,315,3); $hero->save();
$hero = new Hero();
$hero->setAll('Silhouette','Physical',473,17,18,23,600,300,4.5); $hero->save();
$hero = new Hero();
$hero->setAll('Sir Benzington','Magic CC',530,20,17,20,128,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Swiftblade','Physical',530,20,17,20,128,305,2); $hero->save();
$hero = new Hero();
$hero->setAll('Valkyrie','Physical Magic',473,17,17,20,600,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Wildsoul','Physical MUC',473,17,13,24,550,315,4.5); $hero->save();
$hero = new Hero();
$hero->setAll('Zephyr','Tank Magic',473,17,15,18,128,295,1.5); $hero->save();
$hero = new Hero();
$hero->setAll('Arachna','Physical',492,18,15,23,600,295,1.5); $hero->save();
$hero = new Hero();
$hero->setAll('Blood Hunter', 'Physical Magic',587,23,18,24,128,320,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Bushwack','Physical',454,16,14,27,450,300,2); $hero->save();
$hero = new Hero();
$hero->setAll('Chronos','CC Physical',587,23,15,21,128,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Corrupted Disciple','Physical',511,19,19,22,475,300,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Dampeer','Magic',549,21,16,24,128,305,2); $hero->save();
$hero = new Hero();
$hero->setAll('Fayde','Magic CC',492,18,20,19,128,300,3); $hero->save();
$hero = new Hero();
$hero->setAll('Flint Beastwood','Physical',492,18,17,21,570,290,1.5); $hero->save();
$hero = new Hero();
$hero->setAll('Forsaken Archer','Physical Magic',473,17,17,22,600,305,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('Gemini','Magic MUC',511,19,17,22,128,300,4.5); $hero->save();
$hero = new Hero();
$hero->setAll('Grinex','Physical',511,19,16,22,128,310,4.5); $hero->save();
$hero = new Hero();
$hero->setAll('Gunblade','Physical',511,19,14,22,600,310,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Sand Wraith','Physical Tank',511,19,16,23,128,295,3); $hero->save();
$hero = new Hero();
$hero->setAll('Shadowblade','Physical Magic',511,19,19,19,128,310,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Slither','Magic',492,18,16,22,500,290,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Soulstealer','Physical Magic',454,16,19,20,500,300,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('The Dark Lady','Physical',568,22,16,23,128,305,3.5); $hero->save();
$hero = new Hero();
$hero->setAll('Madman','Physical',492,18,16,23,128,300,2.5); $hero->save();
$hero = new Hero();
$hero->setAll('Tremble','Physical MUC',473,17,18,18,128,310,4); $hero->save();

/*
$hero = new Hero();
$hero->setAll('','',); $hero->save();
*/

?>
