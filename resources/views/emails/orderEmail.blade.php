<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<p>Dear <b>{{ $fullName }}</b>,</p>
<p>Lights, camera, action! Your Girly Bag order is now confirmed, and the spotlight is on you. 🛍️✨</p>
<p><b>*Order Confirmation Details:*</b></p>
<ul style="list-style:none;">
  <li><b>- *Order Number:*</b> {{$lastOder->pin}}</li>
  <li><b>- *Order Date:* </b>  {{ $lastOder->created_at->format('d-m-Y') }}</li>
  <li><b>- *Shipping Address:* {{$lastShipAddress->address}},{{$lastShipAddress->dis}},{{$lastShipAddress->phone}}</b></li>
  <li><b>- *Payment Method:* </b> COD</li>
</ul>
<p><b>*Girly Bag:*</b></p>
<p>Your order is your ticket to an enchanting world of health and menstrual cycle empowerment.</p>
<p><b>*Order Summary:*</b></p>
<!--table-->
<table style="width:100%;border: 1px solid black;
  border-collapse: collapse;">
  <tr>
    <th style="border: 1px solid black;
  border-collapse: collapse;">Item Description</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">Quantity</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">Price</th>
  </tr>

  @foreach($lastoOrderList as $allLastoOrderList)
  <tr>
    <td style="border: 1px solid black;
  border-collapse: collapse;">{{$allLastoOrderList->product_name}}</td>
    <td style="border: 1px solid black;
  border-collapse: collapse;">{{$allLastoOrderList->product_quantity}}</td>
    <td style="border: 1px solid black;
  border-collapse: collapse;">৳ {{$allLastoOrderList->product_price}}</td>
  </tr>
 @endforeach
 <tr>
    <td colspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Delivery Charge</td>
    <td style="border: 1px solid black;
  border-collapse: collapse;">৳ <del>70</del> 40</td>

  </tr>
<tr>
    <td colspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Total</td>
    <td style="border: 1px solid black;
  border-collapse: collapse;">৳ {{$lastOder->order_total}}</td>

  </tr>
</table>
<!--end table-->
<p><b>*Shipping Magic:*</b></p>
<p>Your Girly Bag treasures will soon embark on a journey to your doorstep. Get ready to unbox !</p>
<p><b>*Payment Sparkle:*</b></p>
<p>We've gracefully processed your payment of {{$lastOder->order_total}} using your preferred payment method.</p>
<p><b>*Order Status:*</b></p>
<p>Your order is now in our delivery partner's hands. Watch out for a magical shipment confirmation and tracking details coming your way.
    We want to make sure you receive your Girly Bag essentials on time!</p>
{{-- <p><b>*Questions or Style Queries:*</b></p>
<p>Our fashion and cycle-tracking experts are here to assist you. Feel free to reach out for any style advice or cycle-related questions.
     We're always thrilled to chat with our fabulous customers!</p> --}}
<p><b>*Thank you for choosing Girly Bag!*</b></p>
<p>With your order, you've joined a community of empowered women embracing their cycle power and expressing their unique style.
    Stay fabulous and stay tuned for more glamour and cycle insights from Girly Bag!</p>

<p>Sincerely Glamorous, <br>
 The Girly Bag Team, <br>
 thegirlybag@gmail.com, <br>
 <a href="{{ route('index') }}"><b>www.thegirlybag.com</b></a></p>
 <p>P.S. Get ready to shine! Follow us on social media for the latest trends and cycle tips. 🌟👗🌸 </p>
 <p>#GirlyBag</p>
