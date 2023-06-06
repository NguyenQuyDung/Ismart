<div id="wrap-inner" style="font-family:Arial;background-color: #ececec;padding: 15px 0px; font-size: 14px;">
    <div class="content-confirmation" style="padding: 15px; max-width: 600px; background-color: white; margin: 0px auto;">
        <h3 style="margin-top: 0px;">[ ISMART STORE ]cảm ơn {{$fullname}} đã đặt hàng tại Ismart Store</h3>
        <div id="customer">
            <h3 style="color:#f12a43; border-bottom: 1px solid #333">Thông Tin Khách hàng</h3>
            <p>
                <strong>Khách hàng: </strong>
                {{$fullname}}
            </p>
            <p>
                <strong class="info">Email: </strong>
                {{$email}}
            </p>
            <p>
                <strong class="info">Điện thoại: </strong>
                {{$phone}}
            </p>
            <p>
                <strong class="info">Địa chỉ: </strong>
                Thành Phố {{$province}} - {{$district}} - {{$ward}}
            </p>
        </div>
        <div id="order-detail">
            <h3 style="color:#f12a43;border-bottom: 1px solid #333;">Chi tiết đơn hàng </h3>
            <table style="width: 100%; background-color: #eeeeee;" cellspacing="0">
                <thead style="background-color: #f12a43; color: white">
                    <tr class="bold">
                        <td width="10%" style="padding-left:10px;"><strong>Stt</strong></td>
                        <td width="35%" style="padding:5px;"><strong>Tên sản phẩm</strong></td>
                        <!-- <td width="35%" style="padding:5px;"><strong>Ảnh sản phẩm</strong></td> -->
                        <td width="20%" style="text-align: center;"><strong>Giá</strong></td>

                        <td width="15%"><strong>Số lượng</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stt = 0;
                    @endphp
                    @foreach($order as $item)
                    @php
                    $stt++;
                    @endphp
                    <tr>
                        <td style="width:30px;padding-left:10px;">{{$stt}}</td>
                        <td style="padding: 5px;">{{$item->name}}</td>
                        <!-- <td style="padding: 5px;">{{url($item->options->images_product)}}</td> -->
                        <td class="price" style="text-align: center;">

                            {{number_format($item->price,0,' ','.')}}đ
                        </td>

                        <td style="padding-left: 30px !important;">{{$item->qty}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="3" style="font-weight: bold; padding:5px">Tổng giá trị đơn hàng:</td>
                    <td colspan="2" class="total-price" style="font-weight: bold; padding:5px; text-align:right">
                        {{$total}}đ
                    </td>
                </tr>
            </table>
        </div>
        <div id="info">
            <br>
            <p>
                <b style="color:#f12a43">Quý khách đã đặt hàng thành công!</b><br />
                • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng sau thời gian
                2
                đến 3 ngày, tính từ thời điểm này.<br />
                • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
                <b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của cửa hàng chúng tôi. Xin chân thành cảm ơn</b>
            </p>
        </div>
    </div>
</div>