<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Model\Sales AS salesModel;

//Route::get('/det/{id}', function ($id) {
//
//    $invoices = salesModel::find($id);
//    return view('sales.sales_details',[
//      'invoices'=>$invoices
//    ]);
//});

Route::get('/', 'Sales@index');

Route::get('/home', 'Sales@index');

Route::get('/invoiceAdd', 'Sales@invoiceAddPage');

Route::post('/invoiceAdd', 'Sales@invoiceAdd');

Route::get('/invoiceEdit/{id}', 'Sales@invoiceEditPage');

Route::post('/invoiceEdit', 'Sales@invoiceEdit');

Route::get('invoiceShow/{id}', 'Sales@invoiceDetails');

Route::get('invoiceDelete/{id}', 'Sales@invoiceDelete');

Route::get('invoiceDelete/{id}', 'Sales@invoiceDelete');

Route::post('/invoicePay', 'Sales@invoicePay');

Route::get('invoiceDetailsPaid/{id}', 'Sales@invoiceDetailsPaid');

Route::get('invoicePaidDelete/{id}', 'Sales@invoicePaidDelete');

Route::get('/search/main', 'Sales@invoiceMainSearch');

Route::get('search/dateSearch', 'Sales@invoiceDateSearch');

Route::post('/getClient', 'Sales@getClients');

Route::get('/printInvoice/{id}', 'Sales@printInvoice');

Route::get('/printDetailsInvoice/{id}', 'Sales@printDetailsInvoice');

Route::get('/printStatementInvoice/{id}', 'Sales@printStatementInvoice');

Route::get('/invoiceType', 'Sales@invoiceType');

Route::get('/invoiceTypeDelete/{id}', 'Sales@invoiceTypeDelete');

Route::get('search/mainType', 'Sales@typeMainSearch');

Route::get('/invoiceTypeAdd', 'Sales@showAddInvoiceType');

Route::post('/invoiceTypeAdd', 'Sales@addInvoiceType');

Route::get('/invoiceTypeEdit/{id}', 'Sales@showEditInvoiceType');

Route::post('/invoiceTypeEdit', 'Sales@editInvoiceType');

Route::get('/writeHelperAdd', 'Sales@addWriteHelperPage');

Route::post('/writeHelperAdd', 'Sales@addWriteHelper');

Route::get('/manageWriteHelper', 'Sales@manageWriteHelper');

Route::get('/WriteHelperDelete/{id}', 'Sales@WriteHelperDelete');

Route::post('/autoCompleteHelper', 'Sales@autoCompleteHelper');


Route::get('/clientManagement', 'Clients@clientManagement');

Route::get('/addClient', 'Clients@showAddClient');

Route::post('/addClient', 'Clients@addClient');

Route::get('/clientDelete/{id}', 'Clients@clientDelete');

Route::get('/clientEdit/{id}', 'Clients@showEditClient');

Route::post('/clientEdit', 'Clients@editClient');

Route::get('clientSearch', 'Clients@ClientMainSearch');

Route::get('clientSpecialtyManagement', 'Clients@clientSpecialtyManagement');

Route::get('/clientSpecialtyDelete/{id}', 'Clients@clientSpecialtyDelete');

Route::get('/clientSpecialtyAdd', 'Clients@clientSpecialtyAddPage');

Route::post('/clientSpecialtyAdd', 'Clients@clientSpecialtyAdd');

Route::get('/clientSpecialtyEdit/{id}', 'Clients@clientSpecialtyEditPage');

Route::post('/clientSpecialtyEdit', 'Clients@clientSpecialtyEdit');

Route::get('/clientSpecialtyMainSearch', 'Clients@clientSpecialtyMainSearch');

Route::post('/companyAutoComplete', 'Clients@autoCompleteCompany');

Route::post('/autoCompleteLocation', 'Clients@autoCompleteLocation');



Route::get('/paymentMethodAdd', 'PaymentMethod@addPaymentPage');

Route::post('/paymentMethodAdd', 'PaymentMethod@addPayment');

Route::get('/paymentMethod', 'PaymentMethod@paymentMethod');

Route::get('/paymentMethodDelete/{id}', 'PaymentMethod@paymentMethodDelete');

Route::get('/paymentMethodEdit/{id}', 'PaymentMethod@editPaymentPage');

Route::post('/paymentMethodEdit', 'PaymentMethod@editPayment');

Route::get('/searchPayment', 'PaymentMethod@searchPayment');



Route::get('/employeeManage', 'Employee@employeeManage');

Route::get('/employeeDelete/{id}', 'Employee@employeeDelete');

Route::get('/employeeAdd', 'Employee@employeeAddPage');

Route::post('/employeeAdd', 'Employee@employeeAdd');

Route::get('employeeEdit/{id}', 'Employee@employeeEditPage');

Route::post('/employeeEdit', 'Employee@employeeEdit');

Route::get('employeeMainSearch', 'Employee@employeeMainSearch');

Route::get('/monthSalaryManage', 'Employee@monthSalaryManage');

Route::get('/monthSalaryDelete/{id}', 'Employee@monthSalaryDelete');

Route::get('/monthSalaryAdd', 'Employee@monthSalaryAddPage');

Route::post('/monthSalaryAdd', 'Employee@monthSalaryAdd');

Route::get('/monthSalaryEdit/{id}', 'Employee@monthSalaryEditPage');

Route::post('/monthSalaryEdit', 'Employee@monthSalaryEdit');

Route::get('/monthSalaryMainSearch', 'Employee@monthSalaryMainSearch');

Route::get('/monthSalaryDateSearch', 'Employee@monthSalaryDateSearch');

Route::get('/departmentManage', 'Employee@departmentManage');

Route::get('/departmentDelete/{id}', 'Employee@departmentDelete');

Route::get('/departmentAdd', 'Employee@departmentAddPage');

Route::post('/departmentAdd', 'Employee@departmentAdd');

Route::get('/departmentEdit/{id}', 'Employee@departmentEditPage');

Route::post('/departmentEdit', 'Employee@departmentEdit');

Route::get('/departmentSearch', 'Employee@departmentSearch');

Route::get('/printMonthSalary/{id}', 'Employee@printMonthSalary');



Route::get('/expensesManage', 'Expenses@expensesManage');

Route::get('expensesDelete/{id}', 'Expenses@expensesDelete');

Route::get('/expensesAdd', 'Expenses@expensesAddPage');

Route::post('/expensesAdd', 'Expenses@expensesAdd');

Route::get('expensesEdit/{id}', 'Expenses@expensesEditPage');

Route::post('expensesEdit', 'Expenses@expensesEdit');

Route::get('/expensesTypeAdd', 'Expenses@expensesTypeAddPage');

Route::post('/expensesTypeAdd', 'Expenses@expensesTypeAdd');

Route::get('/expensesTypeManage', 'Expenses@expensesTypeManage');

Route::get('/expensesTypeDelete/{id}', 'Expenses@expensesTypeDelete');

Route::get('/expensesTypeEdit/{id}', 'Expenses@expensesTypeEditPage');

Route::post('/expensesTypeEdit', 'Expenses@expensesTypeEdit');

Route::get('/expensesMainSearch', 'Expenses@expensesMainSearch');

Route::get('/expensesDateSearch', 'Expenses@expensesDateSearch');



Route::get('/printingManage', 'Printing@printingManage');

Route::get('/printingDelete/{id}', 'Printing@printingDelete');

Route::post('/getCompany', 'Printing@getCompany');

Route::get('/printingAdd', 'Printing@printingAddPage');

Route::post('/printingAdd', 'Printing@printingAdd');

Route::get('/printingEdit/{id}', 'Printing@printingEditPage');

Route::post('/printingEdit', 'Printing@printingEdit');

Route::get('/printingMainSearch', 'Printing@printingMainSearch');

Route::get('/printingDateSearch', 'Printing@printingDateSearch');

Route::get('/printingCompanyManage', 'Printing@printingCompanyManage');

Route::get('/printingCompanyDelete/{id}', 'Printing@printingCompanyDelete');

Route::get('/printingCompanyAdd', 'Printing@printingCompanyAddPage');

Route::post('/printingCompanyAdd', 'Printing@printingCompanyAdd');

Route::get('/printingCompanyEdit/{id}', 'Printing@printingCompanyEditPage');

Route::post('/printingCompanyEdit', 'Printing@printingCompanyEdit');

Route::get('/printingCompanyMainSearch', 'Printing@printingCompanyMainSearch');



Route::get('/promotionItemManage', 'PromotionItem@promotionItemManage');

Route::get('/promotionItemAdd', 'PromotionItem@promotionItemAddPage');

Route::post('/promotionItemAdd', 'PromotionItem@promotionItemAdd');

Route::get('/promotionItemDelete/{id}', 'PromotionItem@promotionItemDelete');

Route::get('/promotionItemEdit/{id}', 'PromotionItem@promotionItemEditPage');

Route::post('/promotionItemEdit', 'PromotionItem@promotionItemEdit');

Route::get('/promotionItemMainSearch', 'PromotionItem@promotionItemMainSearch');

Route::get('/promotionItemDateSearch', 'PromotionItem@promotionItemDateSearch');

Route::get('/companyAddPage', 'PromotionItem@companyAddPage');

Route::post('/companyAdd', 'PromotionItem@companyAdd');

Route::get('/promotionItemCompanyManage', 'PromotionItem@promotionItemCompanyManage');

Route::get('/promotionItemCompanyDelete/{id}', 'PromotionItem@promotionItemCompanyDelete');

Route::get('/promotionItemCompanyEdit/{id}', 'PromotionItem@promotionItemCompanyEditPage');

Route::post('/promotionItemCompanyEdit', 'PromotionItem@promotionItemCompanyEdit');

Route::get('/promotionItemCompanySearch', 'PromotionItem@promotionItemCompanySearch');




Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::get('/userEdit/{id}', 'Users@userEditPage');

Route::post('/userEdit', 'Users@userEdit');

Route::get('/userManage', 'Users@userManage');

Route::get('/userDelete/{id}', 'Users@userDelete');

Route::get('/userDelete/{id}', 'Users@userDelete');

Route::get('/userPictureEdit', 'Users@userPictureEditPage');

Route::Post('/userPictureEdit', 'Users@userPictureEdit');

Route::get('/passwordEdit', 'Users@passwordEditPage');

Route::post('/passwordEdit', 'Users@passwordEdit');


Route::get('/deliveryManage', 'Delivery@deliveryManage');

Route::get('/deliveryDelete/{id}', 'Delivery@deliveryDelete');

Route::get('/deliveryAdd', 'Delivery@deliveryAddPage');

Route::post('/deliveryAdd', 'Delivery@deliveryAdd');

Route::get('/deliveryEdit/{id}', 'Delivery@deliveryEditPage');

Route::post('/deliveryEdit', 'Delivery@deliveryEdit');

Route::get('/deliveryTypeManage', 'Delivery@deliveryTypeManage');

Route::get('/deliveryTypeDelete/{id}', 'Delivery@deliveryTypeDelete');

Route::get('/deliveryTypeAdd', 'Delivery@deliveryTypeAddPage');

Route::post('/deliveryTypeAdd', 'Delivery@deliveryTypeAdd');

Route::get('/deliveryTypeEdit/{id}', 'Delivery@deliveryTypeEditPage');

Route::post('/deliveryTypeEdit', 'Delivery@deliveryTypeEdit');

Route::get('/deliveryMainSearch', 'Delivery@deliveryMainSearch');

Route::get('/deliveryDateSearch', 'Delivery@deliveryDateSearch');

Route::get('/deliveryTypeMainSearch', 'Delivery@deliveryTypeMainSearch');



Route::get('/debtManage', 'Debt@debtManage');

Route::get('/debtDelete/{id}', 'Debt@debtDelete');

Route::get('/debtAdd', 'Debt@debtAddPage');

Route::post('/debtAdd', 'Debt@debtAdd');

Route::get('debtEdit/{id}', 'Debt@debtEditPage');

Route::post('/debtEdit', 'Debt@debtEdit');

Route::post('/debtPay', 'Debt@debtPay');

Route::get('/debtMainSearch', 'Debt@debtMainSearch');

Route::get('/debtDateSearch', 'Debt@debtDateSearch');

Route::get('/debtNameManage', 'Debt@debtNameManage');

Route::get('/debtNameDelete/{id}', 'Debt@debtNameDelete');

Route::get('/debtNameAdd', 'Debt@debtNameAddPage');

Route::post('/debtNameAdd', 'Debt@debtNameAdd');

Route::get('/debtNameEdit/{id}', 'Debt@debtNameEditPage');

Route::post('/debtNameEdit', 'Debt@debtNameEdit');

Route::get('/debtNameMainSearch', 'Debt@debtNameMainSearch');

Route::get('/debtPaidManage', 'Debt@debtPaidManage');

Route::get('/debtPaidDetailsManage/{id}', 'Debt@debtPaidDetailsManage');

Route::get('/debtPaidDelete/{id}', 'Debt@debtPaidDelete');

Route::get('/debtPaidMainSearch', 'Debt@debtPaidMainSearch');

Route::get('/debtPaidDateSearch', 'Debt@debtPaidDateSearch');


Route::get('/analysis', 'Analysis@analysisMoney');

Route::get('/analysisDateSearch', 'Analysis@analysisDateSearch');

Route::get('/profitChart', 'Analysis@profitChart');

Route::get('/profitChartDate', 'Analysis@profitChartDate');




Route::get('/projectAdd', 'ProjectManagment@projectAddPage');

Route::post('/projectAdd', 'ProjectManagment@projectAdd');

Route::get('/projectManage', 'ProjectManagment@projectManage');

Route::get('/projectDelete/{id}', 'ProjectManagment@projectDelete');

Route::get('/projectEdit/{id}', 'ProjectManagment@projectEditPage');

Route::post('/projectEdit', 'ProjectManagment@projectEdit');

Route::get('/projectMainSearch', 'ProjectManagment@projectMainSearch');

Route::get('/projectDateSearch', 'ProjectManagment@projectDateSearch');


Route::get('/projectTypeAdd', 'ProjectManagment@projectTypeAddPage');

Route::post('/projectTypeAdd', 'ProjectManagment@projectTypeAdd');

Route::get('/projectTypeManage', 'ProjectManagment@projectTypeManage');

Route::get('/projectTypeDelete/{id}', 'ProjectManagment@projectTypeDelete');

Route::get('/projectTypeEdit/{id}', 'ProjectManagment@projectTypeEditPage');

Route::post('/projectTypeEdit', 'ProjectManagment@projectTypeEdit');

Route::get('/projectTypeMainSearch', 'ProjectManagment@projectTypeMainSearch');



Auth::routes();

