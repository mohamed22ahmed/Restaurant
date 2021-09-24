<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>

<body>
    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <div class="container">
        <div class="container" id='printMe'>
            <div class="row justify-content-center">
                <div class="mb-5">
                    <img src="storage/noImage.jpg" alt="logo" width="100px" height="100px" class="rounded-circle">
                </div>
                <table class="table table-bordered m-2" dir='rtl'>
                    <tbody>
                        <tr>
                            <th>اسم العميل</th>
                            <td>
                                {{ $order->name }}
                            </td>
                            <th>عدد الطلبات</th>
                        </tr>
                        <tr>
                            <th>رقم العميل</th>
                            <td>
                                {{ $order->phone }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>عنوان العميل</th>
                            <td>
                                {{ $order->address }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>سعر التوصيل</th>
                            <td>
                                {{ $delivery->delivery_price }}
                            </td>
                            <td></td>
                        </tr>
                        @for($i = 0; $i < count($foods); $i++)
                            <tr>
                                <th>{{ $foods[$i]->food }}</th>
                                <td>
                                    {{ $foods[$i]->price }}
                                </td>
                                <td>{{ $order_numbers_array[$i] }}</td>
                            </tr>
                        @endfor
                        
                        <tr>
                            <th>السعر الاجمالى</th>
                            <th>
                                {{ $order->total_price + $delivery->delivery_price }}
                            </th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button onclick="printDiv('printMe')" class="btn btn-primary px-4" style="margin-left:45%">Print</button>
</body>

</html>
