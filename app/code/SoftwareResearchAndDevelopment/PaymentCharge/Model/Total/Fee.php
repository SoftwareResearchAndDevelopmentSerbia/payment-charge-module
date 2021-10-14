<?php

namespace SoftwareResearchAndDevelopment\PaymentCharge\Model\Total;

use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\QuoteValidator;
use SoftwareResearchAndDevelopment\PaymentCharge\Helper\Data;

class Fee extends AbstractTotal
{
    /**
     * Collect grand total address amount
     *
     * @param Quote $quote
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    /**
     * @var Data
     */
    protected $helperData;

    public function __construct(
        QuoteValidator $quoteValidator,
        Data $helperData
    ) {
        $this->quoteValidator = $quoteValidator;
        $this->helperData = $helperData;
    }
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        /**
         * //$quote->getFee();
         */
        $exist_amount = 0;
        /**
         * //Excellence_Fee_Model_Fee::getFee();
         */
        // $fee = 100;
        $fee = $this->getFeeAmount();
        $balance = $fee - $exist_amount;

        $total->setTotalAmount('fee', $balance);
        $total->setBaseTotalAmount('fee', $balance);

        $total->setFee($balance);
        $total->setBaseFee($balance);

//        $total->setGrandTotal($total->getGrandTotal() + $balance);
//        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);

        return $this;
    }

    protected function clearValues(Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    /**
     * @param Quote $quote
     * @param Total $total
     * @return array|null
     */
    /**
     * Assign subtotal amount and label to address object
     *
     * @param Quote $quote
     * @param Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(Quote $quote, Total $total)
    {

        return [
            'code' => 'fee',
            'title' => 'Fee',
            'value' => $this->getFeeAmount()
        ];
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Fee');
    }

    /**
     * @return int
     */
    private function getFeeAmount()
    {
        $value = 0;
        $enable = $this->helperData->getGeneralConfig('enable');
        $amount = $this->helperData->getGeneralConfig('amount');

        if ($enable && $amount > 0) {
            $value = $amount;
        }
        return $value;
    }
}
