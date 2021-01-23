<?php
use Renaldy\PhpFPGrowth\FPGrowth;

$transactions = [
    ['sp trochess', 'woods antitusif'],
    ['woods antitusif', 'vipro g', 'betadine', 'decolsin', 'bodrex'],
    ['sp trochess', 'vipro g', 'betadine', 'hansaplast', 'kalpanax'],
    ['sp trochess', 'betadine', 'hansaplast'],
    ['woods antitusif', 'sp trochess', 'minyak tawon', 'vipro g'],
    ['vipro g', 'betadine', 'sp trochess', 'woods antitusif'],
    ['sp trochess', 'antangin cair'],
    ['woods antitusif', 'vipro g', 'sp trochess'],
    ['sp trochess', 'woods antitusif', 'betadine'],
    ['woods antitusif', 'vipro g', 'hansaplast'],
];

//Percentage (0-1)
$support = 0.2;
$confidence = 0.75;

$fpgrowth = new FPGrowth($transactions, $support, $confidence);
$fpgrowth->run();
// print_r($fpgrowth);

print_r("=========> Dataset:\n");
print_r($transactions);

print_r("=========> Frequent Itemset:\n");
print_r($fpgrowth->getFrequentItemSet());

print_r("=========> Ordered Item:\n");
print_r($fpgrowth->getOrderedItemSet());

print_r("=========> FP Tree:\n");
print_r($fpgrowth->getTree());

print_r("=========> Frequency Pattern:\n");
print_r($fpgrowth->getPatterns());

print_r("=========> Association Rules:\n");
print_r($fpgrowth->getRules());
?>