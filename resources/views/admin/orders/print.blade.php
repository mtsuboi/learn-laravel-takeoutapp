<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!-- Styles -->
  <style>
    body {
        font-family: ipaexg !important;
    }
    p {
      margin: 0;
    }
    @page {
      margin: 10px 30px;
    }
    .page-break {
      page-break-after: always;
    }
  </style>
  <title>Orders.pdf</title>
</head>
<body>
  @foreach ($orders as $order)
    <h1>注文票</h1>

    <!-- ヘッダー -->
    <table>
      <tr>
        <td style="width: 120px;">
          <p style="font-size: 12px;">注文番号:</p>
          <p style="font-size: 18px;">{{ $order->id }}</p>
        </td>
        <td>
          <p style="font-size: 12px;">顧客名:</p>
          <p><span style="font-size: 18px;">{{ $order->user->name }}</span><span style="font-size: 12px;">様</span></p>
        </td>
      </tr>
      <tr>
        <td style="width: 100px;">
          <p style="font-size: 12px;">予約日:</p>
          <p style="font-size: 18px;">{{ $order->scheduled_date }}</p>
        </td>
        <td>
          <p style="font-size: 12px;">予約時間:</p>
          <p><span style="font-size: 18px;">{{ $order->scheduled_time }}</span><span style="font-size: 12px;">時</span></p>
        </td>
      </tr>
    </table>

    <!-- 明細 -->
    <table style="margin-top: 20px;">
      @foreach ($order->orderDetails as $detail)
        <tr>
          <td style="width: 20px; font-size: 14px;">
            {{ $loop->iteration }}
          </td>
          <td style="width: 180px; font-size: 14px;">
            {{ $detail->item_name }}
          </td>
          <td style="width: 40px; font-size: 14px; text-align: right;">
            {{ $detail->quantity }}個
          </td>
          <td style="width: 70px; font-size: 14px; text-align: right;">
            {{ number_format($detail->quantity * $detail->unit_price) }}円  
          </td>
        </tr>
      @endforeach
    </table>

    <!-- フッター -->
    <table style="margin-top: 20px;">
      <tr>
        <td style="width: 80px;">
          <p style="font-size: 12px;">商品点数:</p>
          <p><span style="font-size: 18px;">{{ $order->quantity }}</span><span style="font-size: 12px;">点</span></p>
        </td>
        <td>
          <p style="font-size: 12px;">合計金額:</p>
          <p><span style="font-size: 18px;">{{ number_format($order->price) }}</span><span style="font-size: 12px;">円(税込み)</span></p>
        </td>
      </tr>
    </table>

    <!-- 改ページ -->
    @if(!$loop->last)
      <div class="page-break"></div>
    @endif
  @endforeach
</body>
</html>