
# Point Of Sales API

Response schema: JSON Object {
"success": boolean,
"message_code": string,
"body": Array
}



GET /transaction/sellers

- Fetches all transactions from transactions table
- Request Arguments: None
- 404 will be returned if no transaction was found


GET /All_items

- Fetches all items from stocks
- Request Arguments: None
- 404 will be returned if no item was found


POST /transaction/create

- creates new transaction
- Request Arguments: {"item_name": string ,"item_quantity": integer ,"total": integer}
- 422 will be returned if item_name param was not found
- 422 will be returned if item_quantity param was not found
- 422 will be returned if total param was not found
- 500 will be returned if sql statment not excute 

PUT /item_Qty/update

- Updates the quantity of the item
- Request Arguments: {"id": integer,"quantity": integer}
- 422 will be returned if id param was not found
- 422 will be returned if quantity param was not found
- 404 will be returned if no item was found
- 500 will be returned if sql statment not excute 


PUT /transaction_Qty/update

- Updates the current transaction amount and the quantity in the stock
- Request Arguments: {"id": integer,"quantity": integer,"item_id":integer}
- 422 will be returned if id param was not found
- 422 will be returned if quantity param was not found
- 404 will be returned if no transaction was found
- 500 will be returned if sql statment not excute 

DELETE /item_sales/delete

- deletes the current transaction amount
- Request Arguments: {"id": integer}
- 422 will be returned if id param was not found
- 500 will be returned if sql statment not excute 