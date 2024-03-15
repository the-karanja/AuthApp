<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAuthn Laravel Project Documentation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            padding-top: 3rem;
        }
        .bs-sidebar {
            position: fixed;
            top: 3rem;
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 0;
            overflow-x: hidden;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
        }
        .bs-sidebar a {
            display: block;
            padding: .25rem 1.5rem;
            color: #495057;
            text-decoration: none;
        }
        .bs-sidebar a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">WebAuthn Laravel Project documentation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#introduction">Introduction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#registration">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#authentication">Authentication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#api-reference">API Reference</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light bs-sidebar">
            <div class="position-sticky">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Contents</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#introduction">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#authentication">Authentication</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#api-reference">API Reference</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <button class=" btn btn-outline-danger" style="margin-left: 20px;margin-top:10px">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
            <section id="introduction">
                <img  mb="6"  style="margin-left: 300px;margin-right:auto;"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZ4AAAB6CAMAAAC4AMUdAAAA3lBMVEX///8AVXIATm0AUnAASmoASGkAUG8AV3Tz9/kAS2ozboa6ydAbXnkARGa1ytLG0Nbg5+qTsLxzmqkjZoBYgpYAAAAAQWTo8fOgu8Z8naz3+/xDdIoAXHitvca70NjO2+BijJ+Ep7Xo6Ojv7+/Z2dlFfJGzs7POzs5dXV2VlZVmZmY/Pz+enp5VVVWTk5PQ0NCCgoK7u7tLS0twcHBra2uqqqoqKirCwsKHh4cSEhJ6enpFRUUiIiIAOl8yMjKatcAZGRlOh5wAMFiHsL0odY1wkqNjhZd0obGQp7NReo42a8cTAAAWOklEQVR4nO1dCWOqurZOCCBQQRRHHEBAxXlorW47eHrudZ/2//+ht4K221aB2EG95/nt3VYl6CIfa8jKSkToggsuuOCCCy644IILLvgOtObz0Zg+MJ2dY73tJw4azt4/n/157pg/I902WtcLB/XcP0KtJfbghSa9hpm3kctt717K6eDNR4O1PLPgT88NaejuO9DuN6ctOODOJnBpEpJoM/o+8JPbnCWZyDW73nQgbZ4HB91WC0nuuqUPDNM3QWGf/XWMb2fTHMpJ0+CTJMlBrS59fdSEjx81+4NBk8o2nLiDjrkRxpXW13JKTCfN9q1Lu/Z6Bv0nTV03uK9cE25pKeiwoEvdeQ/6WZLen90bwcFFs92+zg17fd8Z+KPrTneAfL8f0DPo92e9JvKbuc6427lBPd/3Bv5k0cqNptOh3x84ff+69evO9Du+dNOf/9hlTkBXhyjn3LiL65HTv7mdLXJUfW/hgvwWmvrt8bjvN0e/5t2+d9Px3YU/6N50R3ejHxOJCdMFcm/dQd93R+NHNGv7bv/msen6N3cgfdvvdGiXjnv+pDsZQLcP35/dy3Vvh+7tBA19lBsObhZz1G+5j6jZ+suj9Mxao0V7irpu12mO0O2wO+v58ykwl0O96cRDTWc8u3U63nSEBr1+88euErQXfgE9/aY/7E7v3Oa1A/qOxgv41Zn4j95g3PJ6vtNH8zF0SXtw00M5czoyJz+n0Sxo/urfL7xH6MZ562bY8bruvTvstHvoBizOnP6ZeYPr3jUC7c+h+w9nt9vwy32coBbQMxu3rmeo77l3w7tW16H09JvtUW+KHik9bfTY6o7HrdFsQ08XLMzYh5Ydr9dDzUH/By1JB6zaLzfn+NPOrNmaSLNr747KR283fwwUzMf+tHftAT3NXhtNRzegayCTdGJ64L5Fj7PubDwctUDhoSdvXe8GuFhQeqZwU/vN9qLdBLFRZzH4cHbv3u/3OuPewsl5nXl/vFjT0+r2cs0cvWnbYN0eBzm3c90coFv3ZgQGZAwX3p1PQX2uF+N+Ozee++6v9i9n8oP0eH+N+guU8/pet3fnTdzZtZsbgt2gx/rUys3Hd+2bW+d2PJ8694Nbr7Ohp39i7QH1vnX8eT+4q+EOD7THeZz/BfQMuu2ccwddDB60N3FbuY8d6LRaLc+l/t2D2AzCHhN51GF5LccJPFjL8ZADLcyhC20QbePQEMAcghtz4N71htAQooTWTwYGAJOGZh71+PBJHjLB3YIoQbjmBQ7WRC2QB8R2X4WBX87PCsUgtrsRjUYHv6g4ILLkTV1/RrVn6AZdDC3Q0Bx2Tyvr/3P4b7bLXXTBWIOH3z7s3HtHF+mCCy644Nwg7cepxboAkHpKhsCo60eXxrRSX4F1dIHfCa9brCgwvuOKF0kY5ETxZ69nR5q0QXjh8+CJcmSJt5DKGBUisgEnFaZ73+YxJxp7keQJ5rUfv6otmFmBEJH7POBOE7LHlPgPrAbPhd7ne+99sopVoZqA5UwhBJYiksQxLu0VWRlzZTvzedhlHvP2MUV+RRE0guOMMiOUJC9i2UjFvOtKFO3wo4Uk5mvfeRHRqPKYpL82oWSmOaweUeRXLFUsVjJWwWSEVEjZoEFiND+mQsQob1rn+OX3XkcUkkROf/lN6jJRvkGWwwBGiCszevs3WIZIkpEOSDJIIupdizJXOvBDPw9LJAadx3r+nf0cflNyTRGrh3bUV2EaRCwffppuEM6OanBW9Giy+Bv+ZAXG6GcXwgrObxDh2NZNEzD5zCgxxRExSn3Oip4rnn6YpuJ3EMnbQ7DVbw8xwXsggKW2xaPT81vkPucDbJGPMuc79BTee6Jj07OivuM9O6syoWwAN6Sh2JWAFoIN0U6uX31PT+oU9EiYVXk0LYh8asVNc0uIdJQf6ann1cq2tp2CHm67v8F3FoWK0ZDhR0hnGsR4Ipxi8Fa5kUg0ErgCP1vgT0KPrm462Vyu/qC0a7ayDw9l4Kf08LChs5AgiYhQ9QM9Vh5jrrF1/OT0cKX6VaJqVatLq6rVV6mGVbQy1dSTvqqVrbqV1euWcHJ6agJZd9pVnttyhC8f21n5ovYA5umhZOXXxjDGuXw4vOThft0eiJ6cHhnoqC/Lf9eWjb+t9OrqP6UHYv/HytaIVir+vXwu8mdAj/VKTyrP/4Fq77azVyrQw5efH9a5p8JB9MDnvB90n5oekq0JirWsrrSlltHSmdST9VzUSlaptqq9gPbYGj4DelwVJ9ePasUt7FqtpZqnkUCKf7DXLxQISUa88UflKopqY9vJnZoebBgQBhQztlzN2AkjqZCyjZO20TCeDGzYRsLAyul9j5SMjo+3Wq4713ztc40XG+Gtd22f+T4COTk9NDrjbIUT4Wf9nNBYmwQRm4g/4jT0oBXH1T91YlbkozLs5zbuAXpK2/Z7Y8WF9U88Hq5OQk9KBSf5ifOKMo7s/jOkx9K+gsJJ6EFZjlQOzyTVCBEik4xnSE9B/wokdnrM1//o9ff7g4dATxBSiZsd+PgRRQKjmMgPOkN66iqLFQtBnt24ub5j3nronvaPswhemkzXh7yZe3Og7BY4RNnW4AYJmzx7B2i3LPNEjslynyM98o7D/5i6CcchSR2/1co13V+o1XOd/nTqouFdDqEZcrz5ZDhpNZE3PGD9kK4IWBR4RkETtCnh7ZhU0DnSw+1eTDLJSNAhkVuvR4vSBy1/NvH+ao86aDG7mQFdzVHb9+6n/njQH+fYpTfTCSG8amMXHG/EFgp8pMeUJGnbGp4FPYRmcgxZJpyMOfqP8DImMliTnaaH0OM8+u79Yri46d2NfSR13dyo3zFvUbM9G7kTNO21m+gAesBrak9KWNHTDhQ7FZ9FfU+Ptarwqqik/7xyHvRktYdlplRspIvGczKdfDauiqRRzb6k0x/bHkKPdHuHFjnU7qGed+t4d80+WDs3h+bt2cK9Q9P2ofRQmCElg58rIdymR28IXJCj5/m3MdZ50NPQ/ymUrUxx1dDSJWtVey5mFOu/1rOV/Ir2oPaUrukyO39N3YXfHQ6GCA1mg8dF05mMR2jWbM5Q/4cvOQZb9FhExBxPKjIvYuE103Ae9DxV/25c1YhWrtRegJS0krH+sVb/lNI7UcSJsgZrFKqlRoURRuOZYRz7hx4d3JqYppkjKytg+Wl9/Dzoaeia9aIly5ZuJyylpmRrtXKxtlztNj0hPWYmz3MEs0YGIqcasWL+occQRePVzBUFrK5TQWdBD5hbUGmZWl0R8wQiUggTZJ4TzybnBtAhThEFVc0zQoXLULOsgbXGk8SfpGtaDmpmzmbcw4zTTGYDLBVjNasxJ3ZMfWkImDMYh6WN9zUJRlBUwUZPphJjRUtJtu7a0LObEmXHQSnRVTJG8Ngre4OewCRxaFK0yBHWpE4Cc+9qDjg5iN4Y6FnxXDnyMyxVJEyV2mt6vgxWemyei65XrOUJax46Cxb58JSoBrY6ciLilZ4C3lizDa54MeipeHpWPBaeI1sUDBETlg5b01NLfwU6Mz02jyOLmKBzKgRH1tC+wRIw/5kJhSWPkywTCh/pSbHSkwF24vRLN0SCGXrsNSUqfx7sKdGVjOVYwSsQYrF0+4rjMgzNdmCWCV+NOL5t3LanY9MbWuLoKQnx7ATFqiz8hEduW6WI+8sPD47cgB2GoEdPEhaXwj6ZXdC3/9Cif7bJ7KcPocGmEDaaHhPYEe2CFJY0f30kWcBPvH0LHfeUf/82krSmgCRx8ncUQ6z0ADskIzEInmRx+bqKjfWj7bnEPTm1NBapr9ESsr05U2QrBbni8Vb9YZpjCazNLK27Uvav3TIMjJOvDxV4gtWrmKsMo4e/0urWU1UwKpympDVeMbhKMplQEsoOT4z0UMFxqOCJLcGTVHfjBH8rpLKErSn3/I6907lVhhZS4Ub6YR0sMRdSKTAsfeWnCA6FYVjqPgT3NguChpWYqwynZ5XQn4qZpdbQ/6mlV7Vao1hLF+EG3WnLRk9NPUhwLm69XWqrDPEP+B2zZanLalCGmDm4DDEFUUqiKJmmpNsCljcSRWuPQkeQyUQIYFD/9rgCDaOn1VEEPVWrVmpUGyXrpZZMZ1Ocoln4ufQ7XS7yn6JHCqp+mASnJcKRxTQUb0W8Un17qd6OUTSz+TytUyvlHzYBWyHBWuemwb0iC4aSUEUsKxu7GeN7wEiImbBpf8uy3h6C45Bj1+SGa4+t8tlqrVzLpspLW2tk0hb/nFmlXz5JDzIbHCb/sAgOTpOLnzUjjCXwZioVDBGtq8NL4C1DFoNpY463X8eZcZFbVn41g1GQyiIDO6H0BIsUFNsu1m27bpeTy7RQF1/KyouR/eh8WEMDyg8XL5GpiEyLn3+LclR8HI4Vd8ACEi0rgkurbJXWx4574DLVuKUt1JbEGggUEVgHcbUoypwo0sXPHJ0yJUFyeEfRWANryk/MqJQuehOxwJLw0AQctdAgFBbow0HLr8z3jio+a1DmcD666yk7DCr2Ro/whYXz7MNSsxwrFWUnz7ZxgEIixy8hgPESHzmc/YZSkLIsKtE5tzxhYmdDT3H1hYXzK/bVcSYIbkS20PKEkR2kQzQVnd3cd1JSfJ+r2cE30GNmYxKepo3ZdupYL178MpjLEBtxmYyGyLzpRjWPRVw9JCuq18FQxyQbzqyQimRTV19G+fhLfxFdEisSmVQURhgJkcNy3ITFedETTIh+FfKxd5rZQG8AQcxz2dCSEzJx2nZW9KxE9quLvPIjyrwNbVXhBJURolFiyLWeET0FiJZZbUMkRCyeaCs6qeCyosAi4jnRA67yhbGILxKmQWJHNP8jOCN6zG/bq6jK4+QRvoljF4VUmnUAUFpaDOpzRvQs47cqMvVUsV5fanqMS8VE+FyO5UvQV0mBZx5Ay4JRj43Dz4ieSswg3rRKZV7gZY7n1YpdjJIamI6uTvkJpEWOiDLzto0yIXwyLsI8H3o0gVSiurRWFmgNpsjJdMtDkSf1cONgkuPv6ZYVMJfIFln3PL1aNiDGjPOR50OPEilroaFCvMwlG3Y9nXlSML33EuEGrM6JR96yckV3YTxsY1wrPhd5NvRYKubD1cHCIuZIKfWqXnpV4UFDQkUrkE0Z5bFQVbFw8NJ5MxuzXxilB0c1WMqfXLB/KLJixH2gqeDsPwyxNQPuvdAa5RUXtQfnt8NMks9UUpllMXqi3HyJngy0xcg6rG+DruJ8qBZreSxygTKYWqlRzi7XirESsBwWAVgia2nTt4DO93zmPF3EkdqB0nyU+hRBZ4+y8WPUjrMWON315HpdEGiWl1eVQOQih/mwql/Qxk8VBn4Oq0/Plsbc/qCWRGiU9iJjyDh6uui7UODDfQWt8Qv26dQNHot0D3IOk/X6Frhpw+IJi4veb+NbYSqEbD5sq1xuj2LXcDD5olfUjdgaH2OELToxHLJnN8b8cTa1rXMkdKfUEk8qVHf0hEiErGZZtXpC3DjitBAa2ZRJdHX5d4IWYwcP9AoY1XVeVtyzDWWhoih08lqpNB7Wd6P+WoIVikJWFUIqlnk1c5TRnZQgodtl6+J6K2foAoI3blLKgrYFRsHmwrayveJjZiK/EQVx43qu8luJc3m3zi1frD2k6HZ7en7Nnc6R6Blb+u5aerm33F87kncFBxgqpL2pLrfBWlGaCroZPCPBgg0gj9tvFcHgsJSffAvetKdgb2fOd4pLJUMMtt7JCon8umvjtSc472qXiNSBW8R8HhDdh3pWneBg1Z4uBPvRp8rJikFVWtnYrkzo2oAqT6JrIL4PdLP2TQdu7/S+21AvBVVQUn1lvQrJMgBoqDszJNU8axnEl0EzzGHHivx6/F8KBjJLkVp2XikgS8bJwCMJOKQ2mJJ+rCsofWE/NwYZK5uN0wOO1jvu1eWjTZpkRTm0VO5VfhGrFl0Ay1UUGGob1PUHFQVw44ZYNzCZR8vs1ITPzQDWeKb4ckNP3YCRe0Ex6PXWuW/4PgMmFCrhiSVawR/YNpVUqD5wdsGsYZqqSm/yGaXQb3nQMUkeKzgoi5+pc4Ori10CRrGmp2BwyQIMRXl6yvHo0fnwiR49sXYgmgCaAMpTNrW6pNFIIsVt1u+FVl9J5e3F5j8LsLWhI+RQ6GWI21gGZ6/0EErP+nqPSI8YHrdZmwER0LOCcI0vunnVRgmclywivlDiaoL4tP9cyTgePXQrCLlsHRKKSNWkSDBT4vak9MDHhkqZEtb+QxNAqAYR9GClEzywwHQFCTc9tMYfqD3iN8UsBUIEY/XMuET5OZvgsVhhm5U6KT2gFaE+HOix6d+AHoXSowI9tA5UJxt61BDdk5Qj5g2oqBWebsXCuEaZEzHhG4zKfVp6dBlzL/ttsP5q3KhQDV5daw+lp8Dx5bVxI3uNm65w+Hi2LUDaoJkW1mpJWWEO+9f0SIYAoY6WV+k+BUekBxXzWFSNxu43rDUUvAkNKD2WvUR6nlvTg4rZ9b4lMGjaObPRqICtUY9eD6LXqqyoHZCw3QTWVlC4uHym4egx6QHbJYfUv+L1iuTAuFGYtlGj9LzdeSVu7ypRjHn2+vVzR2X3+7yOSg8qlBL5vbWuHOZp6iqgh2pPgC3tobn8feflK/FlSv8zODk9iBax7UNaDmKDgJ4y+B50lS5s+x4I3Cr7zjtJGeJPAej5OL5OH5ue/dDX02pvkZuuqk/ryA28kkTvom/ZJum8UcGk8QHGd3xJ5TegEcxKb+hRaWBdfg2sgR4df+7LC/63UNnjXuNXxh4FFowmdFR7gHCyofK6TrMGJfXBkkT1JdhryD61hD+Pp31+OX+aDVM/wuZobF2sg6rUIRbTwOVL9EGtrqOqfNSCnFNB2uuWTy3VGnoi9LtXLTBtx0wMXLAHNRnLe92/lSSx291c8ONYCpgv787cVEXCKf+ewc3/Luo84Qzt/VBGX8GLypkY4P/n0ESRCMqfNT2mleE4zMdtA33BkaCX6dfd8I3ndFFbPq8qAkc4fBaB/wUBagZPy1llukCOzpVwpYvbOSvUMgmel+myTF74b+TixQtOA6v6XCo9L7WLz7ngggsuuOCCfzlaXvBn93tCndnWE9NBze2wQHLN6fbBC34I82nATdcLetk0XeQCD66LxsH37zrr8vyWL905LnprM742e2tOoeXQp3zBAfe0l/JvxGDa7FxfD3Mjr3M9l7qT6WT06E77N9PZNfT/3aKPuqg1mv/VnCwmY7d/PXf7o27r5rbVQYvOndPzO835/Xjc96dOf3JRo+/GoDkdoBzquoO5153lHO8XGjWbs14noKfn5eDgbOH46M5p+b2Rkxs/ot5gtkDdYRd53rQ1WDgd1HXc+2HuX1UGch4AenroF9AzGnhj4MbrwksdUKkW0NPsbOjxfDRxPL838JrDOzQdjIGeWR/ouRv3QO/MOwk9zk78XaP/SgT03CN/NOyP+s49pac99kfX3SbQM+23c/C6P3Luxz7Q40zmXWcC9AzvW3dmf3HrPM47E+9x1u4sRt6Fnu+H44Jzd5A7RE4rcPbw2JVajudQRzKEP2YLggL6FOKCdRsaDrjwfOYhtwVneg4aDi8B3AUXXHDBBRcw4P8ADhuooJUjvlUAAAAASUVORK5CYII=">
                <h2>Introduction</h2>

                <p>Web Authentication (WebAuthn) is a modern web standard designed to enhance security and usability by enabling passwordless authentication. It is a part of the FIDO (Fast Identity Online) Alliance's efforts to develop open authentication standards that reduce reliance on passwords and improve user authentication experiences.


                    The primary goal of WebAuthn is to provide a robust and user-friendly authentication mechanism that eliminates the need for passwords. By leveraging public key cryptography, WebAuthn allows users to authenticate to websites and applications using biometrics, USB tokens, or other external authenticators.</p>
            </section>

            <section id="registration">
                <h2>Registration</h2>

                <p> During registration, the user's device generates a new public-private key pair and registers the public key with the server. The private key is securely stored on the device and is used to sign authentication requests.</p>
            </section>

            <section id="authentication">
                <h2>Authentication</h2>
                <p>When the user attempts to authenticate, the server sends a challenge to the device. The device then signs the challenge with the private key and sends the signed response back to the server. The server verifies the response using the previously registered public key to authenticate the user.</p>
            </section>

            <section id="api-reference">
                <h2>API Reference</h2>
                <p>The WebAuthn API provides a set of JavaScript methods for interacting with authenticators and performing registration and authentication operations. This section outlines the key methods and objects available in the WebAuthn API.

            <br>                    <b>navigator.credentials.create()</b><br>
                    The  <b> navigator.credentials.create()</b> method is used to initiate the registration process for a new credential.</p><b>Parameters:</b>
                    options: An object containing options for the registration process. This includes parameters such as publicKey, which specifies the parameters for creating a new public key credential.
                    <br><b>
                    Returns:</b>
                    A Promise that resolves with a Credential object representing the newly created credential.<br><br>
                   <b> navigator.credentials.get()</b><br>
                    The <b>navigator.credentials.get()</b> method is used to initiate the authentication process for an existing credential <br>
                   <b> options:</b> An object containing options for the authentication process. This includes parameters such as <b>publicKey</b>, which specifies the parameters for authenticating with an existing public key credential.
Returns:
A Promise that resolves with a Credential object representing the authenticated credential.
            </section>
        </main>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
