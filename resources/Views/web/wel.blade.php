{{-- <link rel="stylesheet" href="/css/productCSS"> --}}
<style>
    table thead tr td {
        color: lightcoral;
    }
    .special-text{
        background: lightblue
    }
    .price{
        color: brown
    }
</style>
   @foreach ($products as $item)
       <table>
        <thead>
            <tr>
                <td>名稱</td>
                <td>價格</td>
                <td>數量</td>
                <td>內容</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if($item->id % 2 === 1)
                    <td class="special-text">{{ $item->title }}</td>
                @else 
                    <td>{{ $item->title }}</td>
                @endif

                <td class={{$item->price < 100 ? 'price':''}}>{{ $item->price }}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->content}}</td>
            </tr>
        </tbody>
       </table>
   @endforeach