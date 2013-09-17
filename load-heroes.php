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
$hero->setAll('Aluna','Magic',454,'47-53',2.52,3.5,600,300,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Oogie','Magic Tank',586,'50-56',4.1,3,128,300,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Maliken','Tank Physical',606,'46-52',1.9,4,128,300,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Lodestone','CC Tank',625,'52-61',4.38,4,128,290,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Accursed','Tank Protective',587,'54-56',4.38,2,128,300,null,'Hellbourne'); $hero->save();

$hero = new Hero();
$hero->setAll('Andromeda','CC',473,'40-50',2.96,3,400,295,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Artillery','Physical',492,'44-48',2.5,2,450,295,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Blitz','Magic CC',473,'43-49',2.58,4,450,330,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Draconis','Physical Magic',492,'44-50',2.22,2,600,300,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Emerald Warden','Physical Magic',430,'44-48',2.08,2,625,290,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Engineer','CC Magic',530,'40-47',3.6,3.5,500,295,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Magebane','Physical',454,'46-50',3.08,2,128,315,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Master of Arms','Magic CC',473,'42-48',3.08,3,550,300,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Monkey King', 'Physical',492,'46-52',4.76,5,128,305,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Moon Queen','Physical Magic',473,'48-54',3.08,2,350,320,2,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Night Hound','Physical',473,'48-52',6.36,2,128,305,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Nomad','Physical',492,'54-58',2.58,3.5,128,310,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Scout','Physical',530,'50-54',4.94,3,128,315,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Silhouette','Physical',473,'41-46',2.72,4.5,600,300,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Sir Benzington','Magic CC',530,'47-56',4.8,3,128,300,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Swiftblade','Physical',530,'44-48',3.9,2,128,305,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Valkyrie','Physical Magic',473,'38-49',1.8,3,600,300,1,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Wildsoul','Physical MUC',473,'46-50',3.36,4.5,550,315,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Zephyr','Tank Magic',473,'48-58',2.52,1.5,128,295,null,'Legion'); $hero->save();
$hero = new Hero();
$hero->setAll('Arachna','Physical',492,'41-52',2.22,1.5,600,295,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Blood Hunter', 'Physical Magic',587,'53-59',3.36,2.5,128,320,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Bushwack','Physical',454,'45-49',3.28,2,450,300,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Chronos','CC Physical',587,'58-64',3.94,3,128,300,2,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Corrupted Disciple','Physical',511,'47-51',2.1,2.5,475,300,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Dampeer','Magic',549,'51-57',2.68,2,128,305,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Fayde','Magic CC',492,'49-53',3.66,3,128,300,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Flint Beastwood','Physical',492,'36-42',2,1.5,570,290,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Forsaken Archer','Physical Magic',473,'44-50',2.08,3.5,600,305,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Gemini','Magic MUC',511,'46-51',4.08,4.5,128,300,2,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Grinex','Physical',511,'51-55',3.72,4.5,128,310,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Gunblade','Physical',511,'45-51',2.98,2.5,600,310,1,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Sand Wraith','Physical Tank',511,'46-50',3.3,3,128,295,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Shadowblade','Physical Magic',511,'51-54',3.66,2.5,128,310,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Slither','Magic',492,'46-48',3.08,2.5,500,290,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Soulstealer','Physical Magic',454,'35-41',1.8,3.5,500,300,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('The Dark Lady','Physical',568,'46-48',4.22,3.5,128,305,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Madman','Physical',492,'47-51',3.22,2.5,128,300,null,'Hellbourne'); $hero->save();
$hero = new Hero();
$hero->setAll('Tremble','Physical MUC',473,'49-54',3.92,4,128,310,null,'Hellbourne'); $hero->save();

/*
$hero = new Hero();
$hero->setAll('','',,'Legion'); $hero->save();
*/

?>
