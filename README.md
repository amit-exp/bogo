# bogo
<b>Note:</b> Implemented entire logic in App\Services\RuleService file.

The Big Diwali Sale: 
The Diwali sale is approaching. The marketing team has decided to run a campaign called “BOGO” - Buy one Get one Free. Customers can buy any number of products. 

# Offer Rule 1: 
Customers can buy one product and get another product for free as long as the price of the product is equal to or less than the price of the first product. 

Customer Objective: Discount maximization for Customers. The customer’s objective is to create a pair of 2 items so that the discount is maximized. 

<b>Example1:</b>
Input: 
Product Price List = [ 10,20,30,40,50,60 ] 
Output:
Discounted Items = 	
Payable Items = [60,40,20]

<b>Example 2:</b>
Input: 
Product Price List = [ 10,20,30,40,50,50,60 ] 
Output:
Discounted Items = [50,40,20]
Payable Items = [60,50, 30,10]

--------------

# Offer Rule 2:  
Customers can buy one product and get another product for free as long as the price of the product is less than the price of the corresponding product in pairs. 

<b>Example 1 :</b>
Input:
Product Price List = [ 10,20,30,40,40,50,60,60 ] 
Output:
Discounted Items = [50,40,30,10]
Payable Items = [60,60,40, 20]

<b>Example 2:</b>
Input:
Product Price List = [ 10,20,30,40,50,50,50,60 ] 
Output:
Discounted Items = [50,40,30,10]
Payable Items = [60,50,50,,20]

--------------

# Offer Rule 3:  
Customers can buy two products and get two products for free as long as the price of the product is less than the price of the first product. 

<b>Example1:</b>
Input:
Product Price List = [ 10,20,30,40,40,50,60,60 ] 
Output:
Discounted Items = [50,40,30,10]
Payable Items = [60,60,40, 20]

<b>Example1:</b>
Input:
Product Price List = [ 5,5,10,20,30,40,50,50,50,60 ] 
Output:
Discounted Items = [50,40,30,10]
Payable Items = [60,50,50,,20,5,5]

