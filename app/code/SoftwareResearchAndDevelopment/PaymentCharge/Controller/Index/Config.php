<?php

namespace SoftwareResearchAndDevelopment\PaymentCharge\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use SoftwareResearchAndDevelopment\PaymentCharge\Helper\Data;

class Config extends Action
{
    protected $helperData;

    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    public function execute()
    {
        $enable = $this->helperData->getGeneralConfig('enable');
        $amount = $this->helperData->getGeneralConfig('amount');

        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents("Enable: {$enable}, Amount: {$amount}");
        return $result;
    }
}
