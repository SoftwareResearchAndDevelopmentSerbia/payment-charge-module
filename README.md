# Payment Charge Module

This module adds the ability for admin to set a fee amount from within admin panel which will affect order totals on 
checkout page.

After copying the module files inside ***app/code*** folder you need to run following commands.

**bin/magento module:enable SoftwareResearchAndDevelopment_PaymentCharge**
**bin/magento setup:upgrade**  
**bin/magento setup:di:compile**  
**bin/magento setup:static-content:deploy -f**  
**bin/magento cache:flush**  

The Payment Charge amount is accessible under following admin configuration section:  

**Stores -> Configuration -> Software Research and Development -> Payment Charge -> General Configuration**.  

When you first access the admin panel the module config options are set to:

**Module Enable -> Yes**  
**Amount -> 0.00** 

Update the amount and click on **Save Config** button.  
Create customer account and proceed to ***checkout/#payment*** page.  
In the **Order Summary** a new item will be displayed, labeled **Fee**, showing the amount you set in the admin panel.  
The **Order Total** will be updated accordingly.  

After placing tan order the Fee amount will also be visible on ***View Order*** page from **My Account -> My Orders** section for the customer.