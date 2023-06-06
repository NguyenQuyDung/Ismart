@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="clearfix detail-blog-page">
    <h1 class="section-title" style="padding-bottom: 50px;text-align:center; font-weight:bold;">CÁCH GIỚI BÀI GIỚI THIỆU VỀ KỸ THUẬT SỐ HAY VÀ HẤP DẪN</h1>
    <!-- </div> -->
    <div class="section-detail" style="max-width:1150px; margin:0px auto;">
        @foreach($introduces as $introduce)
        <h1 style="color:black; font-size:35px; padding-top:20px; margin:0px;">{{$introduce->name}}</h1>
        <p style=" padding-top:20px;">{{$introduce->content}}</p>
        @endforeach
        <a href="" style=" text-align: center; padding-top:50px;">
            <img src="public/images/gioithieu2.jpg" alt="" title="cổng thông tin thuật số !">
        </a>
        <h1 style="padding-top:20px; margin:0px;">Giá trị cốt lõi</h1>
        <p style="padding-top:20px;">Chúng tôi không phải là cửa hàng điện thoại di động đầu tiên nghĩ đến việc mang đến cho khách hàng những sản phẩm và dịch vụ chất lượng cao. Tuy nhiên, với việc nhiều người trong số họ đóng cửa ngày hôm nay, rõ ràng là họ không có bất kỳ giá trị cốt lõi nào để giúp họ. </p>
    </div>
    <div class="section" id="social-wp" style="max-width:1150px; margin:0px auto; margin-top:10px;">
        <div class="section-detail">
            <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            <div class="g-plusone-wp">
                <div class="g-plusone" data-size="medium"></div>
            </div>
            <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
        </div>
    </div>
</div>
</div>
@endsection