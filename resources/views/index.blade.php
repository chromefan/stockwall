<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>股票</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!--第一步：引入Javascript / CSS （CDN）-->
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">精选股</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页</a></li>
                <li><a href="#about">关于我们</a></li>
                <li><a href="#contact">联系我们</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endauth
    </div>
@endif
<div class="container">
    <div class="content">
        <table class="table table-bordered table-hover" id="stock-table">
            <thead>
            <tr>
                <th>股票代码</th>
                <th>股票名称</th>
                <th>最新价格</th>
                <th>当日涨幅</th>
                <th>5日涨幅</th>
                <th>10日涨幅</th>
                <th>30日涨幅</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($stocks as $k=> $stock)
            <tr>
                <td>{{$stock->code}}</td>
                <td><span class="text-primary">{{$stock->name}}</span></td>
                <td>{{$stock->price}}</td>
                @if($stock->day1_chg > 0)
                    <td><span class="text-danger">{{sprintf("%.2f",$stock->day1_chg*100)}}%</span></td>
                @else
                    <td><span class="text-success">{{sprintf("%.2f",$stock->day1_chg*100)}}%</span></td>
                @endif
                @if($stock->day5_chg > 0)
                    <td><span class="text-danger">{{sprintf("%.2f",$stock->day5_chg*100)}}%</span></td>
                @else
                    <td><span class="text-success">{{sprintf("%.2f",$stock->day5_chg*100)}}%</span></td>
                @endif
                @if($stock->day10_chg > 0)
                    <td><span class="text-danger">{{sprintf("%.2f",$stock->day10_chg*100)}}%</span></td>
                @else
                    <td><span class="text-success">{{sprintf("%.2f",$stock->day10_chg*100)}}%</span></td>
                @endif
                @if($stock->day30_chg > 0)
                    <td><span class="text-danger">{{sprintf("%.2f",$stock->day30_chg*100)}}%</span></td>
                @else
                    <td><span class="text-success">{{sprintf("%.2f",$stock->day30_chg*100)}}%</span></td>
                @endif
            </tr>
            @endforeach

            </tbody>
        </table>
        {{ $stocks->links() }}
    </div>
</div>
<script>

        $(document).ready( function () {
        $('#stock-table').DataTable();
    } );
</script>
</body>
</html>
