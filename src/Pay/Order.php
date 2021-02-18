<?php


namespace Starryseer\Apple\Pay;

use EasySwoole\Spl\SplBean;

class Order extends SplBean
{
    protected $receipt;

    public function setReceipt($receipt,$encry=false)
    {
        if(!$encry)
            $this->receipt = $receipt;
        else
            $this->receipt = base64_encode($receipt);
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function toArray(array $columns = null, $filter = null)
    {
        return parent::toArray(null, self::FILTER_NOT_NULL);
    }


}