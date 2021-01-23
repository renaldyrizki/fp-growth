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
        [betadine,hansaplast] => 2
        [hansaplast,vipro g] => 2
        [hansaplast,sp trochess] => 2
        [betadine,hansaplast,sp trochess] => 2
        [betadine,vipro g,woods antitusif] => 2
        [betadine,sp trochess,woods antitusif] => 2
        [betadine,vipro g] => 3
        [betadine,sp trochess,vipro g] => 2
        [betadine,sp trochess] => 4
        [sp trochess,vipro g] => 4
        [sp trochess,vipro g,woods antitusif] => 3
        [vipro g,woods antitusif] => 5
        [woods antitusif] => 7
        [sp trochess,woods antitusif] => 5
        [sp trochess] => 8
    )

### Association Rules

    Array
    (
        [0] => Array
            (
                [antecedent] => betadine,hansaplast
                [consequent] => sp trochess
                [confidence] => 1
                [support] => 0.2
                [liftRatio] => 0.125
            )

        [1] => Array
            (
                [antecedent] => hansaplast,sp trochess
                [consequent] => betadine
                [confidence] => 1
                [support] => 0.2
                [liftRatio] => 0.2
            )

        [2] => Array
            (
                [antecedent] => sp trochess,vipro g
                [consequent] => woods antitusif
                [confidence] => 0.75
                [support] => 0.3
                [liftRatio] => 0.10714285714286
            )

    )