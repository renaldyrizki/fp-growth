# FP-Growth
A PHP implementation of the Frequent Pattern Growth algorithm.
This is modified program from Ivan Rebrov (enzomc/php-fpgrowth).

## Getting Started
You can install the package with composer:
    composer require renaldy/php-fpgrowth

## Usage

#### Example

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

    $support = 0.2;
    $confidence = 0.75;

    $fpgrowth = new FPGrowth($transactions, $support, $confidence);
    $fpgrowth->run();

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

### Output

### List Transaction (Dataset)

    Array
    (
        [0] => Array
            (
                [0] => sp trochess    
                [1] => woods antitusif
            )

        [1] => Array
            (
                [0] => woods antitusif
                [1] => vipro g
                [2] => betadine
                [3] => decolsin
                [4] => bodrex
            )

        [2] => Array
            (
                [0] => sp trochess
                [1] => vipro g
                [2] => betadine
                [3] => hansaplast
                [4] => kalpanax
            )

        [3] => Array
            (
                [0] => sp trochess
                [1] => betadine
                [2] => hansaplast
            )

        [4] => Array
            (
                [0] => woods antitusif
                [1] => sp trochess
                [2] => minyak tawon
                [3] => vipro g
            )

        [5] => Array
            (
                [0] => vipro g
                [1] => betadine
                [2] => sp trochess
                [3] => woods antitusif
            )

        [6] => Array
            (
                [0] => sp trochess
                [1] => antangin cair
            )

        [7] => Array
            (
                [0] => woods antitusif
                [1] => vipro g
                [2] => sp trochess
            )

        [8] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
                [2] => betadine
            )

        [9] => Array
            (
                [0] => woods antitusif
                [1] => vipro g
                [2] => hansaplast
            )

    )

### Frequent Itemset

    Array
    (
        [sp trochess] => Array
            (
                [qty] => 8
                [support] => 0.8
            )

        [woods antitusif] => Array
            (
                [qty] => 7
                [support] => 0.7
            )

        [vipro g] => Array
            (
                [qty] => 6
                [support] => 0.6
            )

        [betadine] => Array
            (
                [qty] => 5
                [support] => 0.5
            )

        [hansaplast] => Array
            (
                [qty] => 3
                [support] => 0.3
            )

    )

### Ordered Item

    Array
    (
        [0] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
            )

        [1] => Array
            (
                [0] => woods antitusif
                [1] => vipro g
                [2] => betadine
            )

        [2] => Array
            (
                [0] => sp trochess
                [1] => vipro g
                [2] => betadine
                [3] => hansaplast
            )

        [3] => Array
            (
                [0] => sp trochess
                [1] => betadine
                [2] => hansaplast
            )

        [4] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
                [2] => vipro g
            )

        [5] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
                [2] => vipro g
                [3] => betadine
            )

        [6] => Array
            (
                [0] => sp trochess
            )

        [7] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
                [2] => vipro g
            )

        [8] => Array
            (
                [0] => sp trochess
                [1] => woods antitusif
                [2] => betadine
            )

        [9] => Array
            (
                [0] => woods antitusif
                [1] => vipro g
                [2] => hansaplast
            )

    )

### FP Tree Structure

    EnzoMC\PhpFPGrowth\FPNode Object
    (
        [value] => 
        [count] => 
        [parent] => 
        [link] => 
        [children] => Array()
    )
### Frequency Pattern

    Array
    (
        [0] => Array
            (
                [item] => hansaplast
                [frequentPattern] => betadine, hansaplast
                [frequent] => 2
            )

        [1] => Array
            (
                [item] => vipro g
                [frequentPattern] => hansaplast, vipro g
                [frequent] => 2
            )

        [2] => Array
            (
                [item] => sp trochess
                [frequentPattern] => hansaplast, sp trochess
                [frequent] => 2
            )

        [3] => Array
            (
                [item] => sp trochess
                [frequentPattern] => betadine, hansaplast, sp trochess
                [frequent] => 2
            )

        [4] => Array
            (
                [item] => woods antitusif
                [frequentPattern] => betadine, vipro g, woods antitusif
                [frequent] => 2
            )

        [5] => Array
            (
                [item] => woods antitusif
                [frequentPattern] => betadine, sp trochess, woods antitusif
                [frequent] => 2
            )

        [6] => Array
            (
                [item] => vipro g
                [frequentPattern] => betadine, vipro g
                [frequent] => 3
            )

        [7] => Array
            (
                [item] => vipro g
                [frequentPattern] => betadine, sp trochess, vipro g
                [frequent] => 2
            )

        [8] => Array
            (
                [item] => sp trochess
                [frequentPattern] => betadine, sp trochess
                [frequent] => 4
            )

        [9] => Array
            (
                [item] => vipro g
                [frequentPattern] => sp trochess, vipro g
                [frequent] => 4
            )

        [10] => Array
            (
                [item] => woods antitusif
                [frequentPattern] => sp trochess, vipro g, woods antitusif
                [frequent] => 3
            )

        [11] => Array
            (
                [item] => woods antitusif
                [frequentPattern] => vipro g, woods antitusif
                [frequent] => 5
            )

        [12] => Array
            (
                [item] => woods antitusif
                [frequentPattern] => sp trochess, woods antitusif
                [frequent] => 5
            )

    )

### Association Rules

    Array
    (
        [0] => Array
            (
                [antecedent] => betadine, hansaplast
                [consequent] => sp trochess
                [confidence] => 1
                [support] => 0.2
                [liftRatio] => 0.12500
            )

        [1] => Array
            (
                [antecedent] => hansaplast, sp trochess
                [consequent] => betadine
                [confidence] => 1
                [support] => 0.2
                [liftRatio] => 0.20000
            )

        [2] => Array
            (
                [antecedent] => sp trochess, vipro g
                [consequent] => woods antitusif
                [confidence] => 0.75
                [support] => 0.3
                [liftRatio] => 0.10714
            )
    )