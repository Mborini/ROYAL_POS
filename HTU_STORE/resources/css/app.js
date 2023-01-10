$(function () {
    //!CHANGE THE COLOR OF OLINE USER
    const v = $(".online");
    let Colored = false;
    setInterval(() => {
        if (Colored) {
            v.css("color", "#1b8a13");
            Colored = false;
        } else {
            v.css("color", "#20e612");
            Colored = true;
        }
    }, 500);



    //!CHANGE THE COLOR OF THE MESSAGE ICONE IF THER IS A MESSAGE OR NOT
    message_value = $('#massege_content').val();
    if (message_value !== "") {
        const message = document.getElementById('massege');
        let isColor = false;
        setInterval(() => {
            if (isColor) {
                message.style.color = '#8f919c';
                isColor = false;
            } else {
                message.style.color = '#1a35ba';
                isColor = true;
            }
        }, 600);
    }


    //!ALERT OF THR MESSAGE
    $("#massege").click(function () {
        message_value = $('#massege_content').val();
        if (message_value !== "") {
            Swal.fire({
                title: 'NEW MESSAGE',
                text: message_value,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = 'md';
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You dont have any message yet !',
            })
        }
    });

    //!PRINT THE SCREEN 
    $("#myprint").click(function () {
        $("#myprint").hide()
        $(".w_p").hide()
        print();
        $("#myprint").show();
        $(".w_p").show();
    });
    //!SEARCH BTN 
    $("#search").blur(function () {
        $(this).val("");
    });

    //!FOUCUS ON SEARCH BTN    
    $("#search").focus();
    $("#I_quantity").change(function () {
        //!THE TOTAL OF THE SELLING 
        $('#I_total').val($('#I_price').val() * $('#I_quantity').val());
        if ($(this).val() <= 0) {
            $(this).val('1');
        }
    });
    //!CHECK  THE ITEM PRICE 
    $("#I_price").change(function () {
        if ($(this).val() <= 0) {
            $(this).val('1');
        }
        $('#I_total').val($('#I_price').val() * $('#I_quantity').val());
    });
    //!hidden the alert
    $(document).ready(function () {
        $('#myDiv').delay(3000).fadeOut(1500);
    });
    $('.info').hide();

    $("#f").mouseenter(function () {

        $("#q").show();
    });

    $("#f").mouseleave(function () {

        $("#q").hide();
    });


    //!FLASH 
    const e = $(".Flash");
    let isColored = false;
    setInterval(() => {
        if (isColored) {
            e.css("color", "white");
            isColored = false;
        } else {
            e.css("color", "black");
            isColored = true;
        }
    }, 500);

    //!==================================( AJAX )==================================================

    const baseUrl = "http://htu_pos.local";
    let totalSales = 0;
    let $totalItem = 0;
    let $user = $("#username").val();

    //! AJAX TO GET ALL THE TRANSACTION THAT HAS BEEN MADE TODAY BY THE CURRENT LOGGED IN USER

    $.ajax({
        type: "GET",
        url: baseUrl + "/transaction/sellers",
        success: function (data) {
            data.body.forEach((item) => {
                $("#transaction_list ").append(`
                <tr data-id=${item.id}>
                <td>${item.item_name}</td>
                <td>${item.item_price}</td>
                <td>${item.item_quantity}</td>
                <td>${item.total}</td>
                <td>${item.created_at}</td>
                <td>
                
                <span class="badge text-bg-secondary">Done</span>
                </td>
                <tr>
                `)
            });
        },
    });


    //! AJAX TO ADD LAST  TRANSACTION THAT HAS BEEN MADE TODAY BY THE CURRENT LOGGED IN USER IN DAILY SALES
    $(".save").on("click", function () {
        $.ajax({
            type: "GET",
            url: baseUrl + "/transaction/sellers",
            success: function (data) {
                totalSales = 0;
                html = '';
                data.body.forEach((item) => {
                    html += '<tr data-id=' + item.id + '>' +
                        '<td>' + item.item_name + '</td>' +
                        '<td>' + item.item_price + '</td>' +
                        '<td>' + item.item_quantity + '</td>' +
                        '<td>' + item.total + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td> <span class="badge text-bg-secondary">Done</span></td>' +
                        '<tr></tr>';
                });
                $('.info').hide();
                $("#transaction_list").html(html);
                $("#total-sales").html(0);
            },
        });
    });

    //!AJAX TO GET ALL THE ITEMS FROM DATABASE
    $.ajax({
        type: "GET",
        url: baseUrl + "/All_items",
        success: function (data) {
            data.body.forEach((element) => {
                if (element.quantity > 0) {
                    $("#items_list").append(`
                <tr data-id="${element.id}">
                <td>  <div class="d-flex align-items-center">
                <img src="${element.photo}" alt="" style="width: 45px; height: 45px" class="rounded-circle" />              
                </div></td>
                <td hidden data-id="${element.barcode}" >${element.barcode}</td>
                <td  data-id="${element.item_name}" >${element.item_name}</td>
                <td data-id="${element.id * 1}">${element.quantity}</th>
                <td>${element.buying_price} JOD</td>
                <td>
                <div class="input-group mb-3"> 
                <input data-id="${element.id}" type="number" class="form-control count" placeholder="Quantity" required>
                <button data-id="${element.id}" class="btn btn-outline-success  border border-0" type="button" id="button-addon1"><i class="fa-solid fa-plus"></i></button>
                </div></td>
                </tr>
                `);
                }
                //?======================= FOR SEARCH ITEM BY PASSWORD OR NAME ===========================
                $('#search').keyup(function () {
                    const search_input = $('#search');
                    const filter = search_input.val();
                    let text = $(`td[data-id="${element.barcode}"],td[data-id="${element.item_name}"]`).text();
                    if (text.includes(filter)) {
                        $(`tr[data-id="${element.id}"]`).show()
                    } else {
                        $(`tr[data-id="${element.id}"]`).hide('slow', function () {})
                    }
                });
                //?=====================================================================================
                if (element.quantity > 0) {
                    $(
                        `tr[data-id="${element.id}"] button[data-id="${element.id}"]`
                    ).click(function (e) {
                        $("#search").val("");
                        e.preventDefault();
                        let count = $(`input[data-id="${element.id}"]`).val();
                        count = Number(count);
                        if (element.quantity >= count) {
                            $totalItem = Number(element.buying_price) * count;
                            if ($totalItem <= 0) {
                                alert(`Please Inter The Quantity`);
                                $(`input[data-id="${element.id}"]`).val("");
                                return;
                            }
                            $('.info').show();
                            totalSales += Number($totalItem);
                            $("#total-sales").text(totalSales + ".JOD");
                            let unit = $(`tr[data-id="${element.id}"] input`).val();
                            element.count = Number(unit);
                            let data = {
                                item_name: element.item_name,
                                item_quantity: element.count,
                                item_Price: element.buying_price,
                                total: $totalItem
                            }
                            //!AJAX TO CREATE NEW TRANSACTIONS
                            $.ajax({
                                type: "POST",
                                url: baseUrl + "/transaction/create",
                                data: JSON.stringify(data),
                                success: function (data) {
                                    data.body.forEach((item) => {
                                        $("#transaction_list").append(`
                                        <tr data-id=${item.id} id=${item.id}>
                                        <td>${item.item_name}</td>
                                        <td>${item.item_price}
                                        <input type="hidden" name='price'data-id=price${item.id} value=${item.item_price}>
                                        </td>
                                        <td>
                                        <input type="number"  min="1" class="form-control  text-center container w-25" value="${item.item_quantity}" quantity-id="${item.id}">
                                        <input type="hidden" value="${item.item_quantity}" pquantity-id="${item.id}">
                                        </td>
                                        <td total-id=${item.id}>${item.total}</td>
                                        <td>${item.created_at}</td>
                                        <td>
                                        <button edit-id="${item.id}" class="btn btn-warning">Edit</button>
                                        <button data-id=${item.id * 100} class="btn btn-danger">Delete</button>
                                        </td>
                                        <tr>
                                        `)
                                        let quantity = element.quantity - element.count;
                                        data = {
                                            id: element.id,
                                            quantity: quantity,
                                        }
                                        //!AJAX TO UPDATE THE ITEM QUANTITY
                                        $.ajax({
                                            type: "PUT",
                                            url: baseUrl + "/item_Qty/update",
                                            data: JSON.stringify(data),
                                            success: function (response) {
                                                $(`td[data-id="${element.id * 1}"]`).text(quantity)
                                                element.quantity = element.quantity - element.count;
                                            },
                                        });
                                        //! AJAX TO DELETE THE SALLES

                                        $(`button[data-id="${item.id * 100}"]`).click(function () {
                                            let item_id = item.id;
                                            let nquantity = $(`input[quantity-id="${item.id}"]`).val();
                                            $edit_total = nquantity * item.item_price;
                                            Number($edit_total);
                                            $.ajax({
                                                type: "DELETE",
                                                url: baseUrl + "/item_sales/delete",
                                                data: JSON.stringify({
                                                    id: item.id
                                                }),
                                                success: function (response) {
                                                    console.log(response);
                                                    totalSales -= $edit_total;
                                                    $("#total-sales").text(totalSales + " JOD");
                                                    $('#' + item.id).remove();
                                                },
                                            });

                                            let quantity = element.quantity + element.count;
                                            x = {
                                                id: element.id,
                                                quantity: quantity,
                                            };
                                            //!AJAX TO UPDATE THE ITEM QUANTITY
                                            $.ajax({
                                                type: "PUT",
                                                url: baseUrl + "/item_Qty/update",
                                                data: JSON.stringify(x),
                                                success: function (response) {
                                                    $(`td[data-id="${element.id * 1}"]`).text(quantity)
                                                    element.quantity = element.quantity + element.count;
                                                },
                                            });
                                        })

                                        let previous_quantity = $(`input[pquantity-id="${item.id}"]`).val();
                                        $(`button[edit-id="${item.id}"]`).click(function () {
                                            let newvalue = $(`input[quantity-id="${item.id}"]`).val();
                                            let price = $(`input[data-id="price${item.id}"]`).val();
                                            let newtotal = $(`td[total-id="${item.id}"]`);
                                            newtotal.text(newvalue * price);

                                            if (newvalue >= previous_quantity) {
                                                totalSales += (newvalue - (previous_quantity)) * item.item_price;
                                                $("#total-sales").text(totalSales + "JOD");
                                                previous_quantity = newvalue;

                                            } else if (newvalue < previous_quantity) {
                                                totalSales -= (((previous_quantity) - newvalue) * item.item_price);
                                                $("#total-sales").text(totalSales + "JOD");
                                                previous_quantity = newvalue;
                                            }

                                            $.ajax({
                                                type: "PUT",
                                                url: baseUrl + "/transaction_Qty/update",
                                                data: JSON.stringify({
                                                    id: item.id,
                                                    quantity: newvalue,
                                                    item_id: element.id
                                                }),
                                                dataType: "application/json",
                                                success: function (response) {
                                                    console.log(response);
                                                },
                                                error: function (e) {
                                                    console.log(data);
                                                },
                                            });
                                        });

                                    });
                                }
                            })
                        } else {
                            alert("Exceeded limit");
                            $(`input[data-id="${element.id}"]`).val("");
                        }
                        $(`input[data-id="${element.id}"]`).val("");
                    })
                } else {
                    $(
                        `button[data-id="${element.id
                        }"]`
                    ).click(function () {
                        alert(`Item ${element.item_name} Empty`);
                        $(`input[data-id="${element.id}"]`).val("");
                    });
                }
            })
        }
    })
})