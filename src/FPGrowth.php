<?php


namespace EnzoMC\PhpFPGrowth;


class FPGrowth
{
    protected $support;
    protected $confidence;
    protected $supportPercentage;
    protected $totalTransactions;
    protected $transactions = array();
    protected $itemSet = array();
    protected $orderedItemSet = array();
    protected $tree;
    private $patterns;
    private $rules;

    /**
     * @return mixed
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * @param mixed $support
     */
    public function setSupport($support)
    {
        $this->support = $support;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     * @param mixed $confidence
     */
    public function setConfidence($confidence)
    {
        $this->confidence = $confidence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return mixed
     */
    public function getFrequentItemSet()
    {   
        $frequentItemSet = array();
        foreach(array_keys($this->itemSet) as $item){
            $frequentItemSet[$item] = array();
            $frequentItemSet[$item]['qty'] = $this->itemSet[$item];
            $frequentItemSet[$item]['support'] = $this->itemSet[$item]/$this->totalTransactions;
        }
        return $frequentItemSet;
    }

    /**
     * @return mixed
     */
    public function getOrderedItemSet()
    {   
        return $this->orderedItemSet;
    }

    
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * FPGrowth constructor.
     * @param $support 1, 2, 3 ...
     * @param $confidence 0 ... 1
     */
    public function __construct($transactions, $support, $confidence)
    {
        $this->transactions = $transactions;
        $this->totalTransactions = count($this->transactions);
        $this->confidence = $confidence;
        $this->supportPercentage = $support;
        $this->support = $support * $this->totalTransactions;
        
    }

    /**
     * Do algorithm
     * @param $transactions
     */
    public function run()
    {
        $this->patterns = $this->findFrequentPatterns($this->transactions, $this->support);
        $this->rules = $this->generateAssociationRules($this->patterns, $this->confidence);
    }

    protected function findFrequentPatterns($transactions, $support_threshold)
    {
        $tree = new FPTree($transactions, $support_threshold, null, null);
        $this->itemSet = $tree->getFrequentItemSet();
        $this->orderedItemSet = $tree->getOrderedItemSet();
        $this->tree = $tree->root;
        $patterns = $tree->minePatterns($support_threshold);
        return $patterns;
    }

    protected function generateAssociationRules($patterns, $confidence_threshold)
    {
        $rules = [];
        foreach (array_keys($patterns) as $itemsetStr) {
            $itemset = explode(',', $itemsetStr);
            $upper_support = $patterns[$itemsetStr];
            for ($i = 1; $i < count($itemset); $i++) {
                foreach (self::combinations($itemset, $i) as $antecedent) {
                    sort($antecedent);
                    $antecedentStr = implode(',', $antecedent);
                    // extract item except antecedent
                    $consequent = array_diff($itemset, $antecedent);
                    sort($consequent);
                    // convert from array to string
                    $consequentStr = implode(',', $consequent);
                    if (isset($patterns[$antecedentStr])) {
                        $lower_support = $patterns[$antecedentStr];
                        $confidence = (floatval($upper_support) / $lower_support);
                        $support = floatval($upper_support / $this->totalTransactions);
                        if (($confidence >= $confidence_threshold) && ($support >= $this->supportPercentage)) {
                            if (isset($patterns[$consequentStr])){
                                $liftRatio = $confidence / $patterns[$consequentStr];
                            }else{
                                $liftRatio = $confidence / $this->itemSet[$consequentStr];
                            }
                            $rules[] = [
                                "antecedent" => $antecedentStr, 
                                "consequent" => $consequentStr, 
                                "confidence" => $confidence, 
                                "support" => $support, 
                                "liftRatio" => $liftRatio
                            ];
                        }
                    }
                }
            }
        }
        return $rules;
    }

    public static function iter($var)
    {

        switch (true) {
            case $var instanceof \Iterator:
                return $var;

            case $var instanceof \Traversable:
                return new \IteratorIterator($var);

            case is_string($var):
                $var = str_split($var);

            case is_array($var):
                return new \ArrayIterator($var);

            default:
                $type = gettype($var);
                throw new \InvalidArgumentException("'$type' type is not iterable");
        }

        return;
    }

    public static function combinations($iterable, $r)
    {
        $pool = is_array($iterable) ? $iterable : iterator_to_array(self::iter($iterable));
        $n = sizeof($pool);

        if ($r > $n) {
            return;
        }

        $indices = range(0, $r - 1);
        yield array_slice($pool, 0, $r);

        for (; ;) {
            for (; ;) {
                for ($i = $r - 1; $i >= 0; $i--) {
                    if ($indices[$i] != $i + $n - $r) {
                        break 2;
                    }
                }

                return;
            }

            $indices[$i]++;

            for ($j = $i + 1; $j < $r; $j++) {
                $indices[$j] = $indices[$j - 1] + 1;
            }

            $row = [];
            foreach ($indices as $i) {
                $row[] = $pool[$i];
            }

            yield $row;
        }
    }
}
