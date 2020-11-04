<?php
namespace Duud\PrivateContent\CustomerData;
use Magento\Customer\CustomerData\SectionSourceInterface;

class CustomSection implements SectionSourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        $randString = $this->getNonceStr();
        return [
            'msg' => $randString,
        ];
    }

    protected function getNonceStr($length = 32)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $str   = 'test ss'.'';
        for ($i = 0; $i < $length; ++$i) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}