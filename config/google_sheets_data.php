<?php
// return [
//     'file_name_1' => [

//         'sheet_name_1' => [
//             'row' => [1, 2, 3],
//             'name' => ['Itachi','Obito','Kakashi'],
//             'surname' => ['Uchiha', 'Uchiha','Hatake'],
//             'birthday' => ['09/09/1997','' ,'NULL'],
//             'address' => ['Gjethe', '' , '' ,]
//         ],

//         'sheet_name_2' => [
//             'row' =>[1],
//             'date' => ['06/03/2012'],
//             'product_name' => ['Test'],
//             'price' => ['30$'],
//             'amount' => ['300'],

//         ],

//     ],

//     'file_name_2' => [

//         'sheet_name_3' => [
//             'row' => [1],
//             'driver_name' => ['JOHN'],
//         ],

//         'sheet_name_4' => [
//             'row' => [1],
//             'pc_name' => ['dell'],
//             'pc_id' => ['123456']
//         ],

//     ],
//     'file_name_3' => [

//         'sheet_name_5' => [
//             'row' => [1,2,3],
//             'driver' => ['Obito2', 'Pain', 'Sasori'],
//             'passager'=> ['Kakashi', '', ''],
//         ],

//     ],
// ];

return [
    'employees_data' => [

        'employee_details' => [
            'row' => [1, 2, 3, 4],
            'name' => ['John', 'Alice', 'Bob', 'Eva'],
            'surname' => ['Doe', 'Smith', 'Johnson', 'Taylor'],
            'birthday' => ['05/21/1985', '08/12/1990', '', '03/05/1988'],
            'address' => ['123 Main St', '456 Oak Ave', '789 Pine Ln', ''],
        ],

        'salary_information' => [
            'row' => [1, 2, 3],
            'date' => ['01/01/2023', '01/01/2023', '01/02/2023'],
            'position' => ['Manager', 'Developer', 'Analyst'],
            'salary' => ['$70,000', '', '$55,000'],
            'bonus' => ['$5,000', '$3,000', ''],
        ],

    ],

    'inventory_data' => [

        'product_sales' => [
            'row' => [1, 2, 3, 4],
            'date' => ['01/15/2023', '01/15/2023', '01/16/2023', '01/16/2023'],
            'product_name' => ['Widget A', 'Widget B', '', 'Widget A'],
            'price' => ['$20', '$30', '$25', '$20'],
            'quantity' => [50, 20, 30, ''],
        ],

        'stock_information' => [
            'row' => [1, 2, 3],
            'product_name' => ['Widget A', 'Widget B', 'Widget C'],
            'current_stock' => [200, '', 150],
        ],

    ],

    'vehicle_data' => [

        'driver_information' => [
            'row' => [1, 2, 3],
            'driver_name' => ['Michael', 'Sarah', 'David'],
        ],

        'vehicle_details' => [
            'row' => [1, 2, 3],
            'vehicle_make' => ['Toyota', 'Ford', 'Honda'],
            'vehicle_model' => ['Camry', 'F-150', 'Civic'],
            'vehicle_year' => [2018, '', 2020],
        ],

    ],
];
