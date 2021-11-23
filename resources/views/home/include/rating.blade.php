@if($count != 0)
            <div class="card-body">
                <div class="container-fluid">
                    <style>
                        .hidden {
                            visibility: hidden;
                            width: 0;
                        }
                        .progress-bar {
                            background: #f1f1f1;
                            border-radius: 5px;
                            /* box-shadow: inset 0 0 0 1px #ccd6dd; */
                            height: 7px;
                            overflow: hidden;
                            position: relative;
                            text-indent: 100%;
                            width: 200px;
                        }
                        .progress-bar--counter {
                            margin-right: 10px;
                            position: relative;
                            top: -4px;
                        }
                        .progress-bar--counter .hidden {
                            display: inline-block;
                        }
                        .progress-bar--wrap {
                            display: flex;
                            font-size: 13px;
                            font-weight: 500;
                            line-height: 1;
                            margin: 10px 0;
                        }
                        .progress-bar--inner {
                            transition: all 0.5s ease-in-out;
                            border-radius: 10px;
                            height: 7px;
                            left: 0;
                            min-height: 7px;
                            position: absolute;
                            top: 0;
                        }

                    </style>
                    <style>
                        .progress-circle {
                            font-size: 20px;
                            /* margin: 20px; */
                            position: relative; /* so that children can be absolutely positioned */
                            padding: 0;
                            width: 5em;
                            height: 5em;
                            background-color: #F2E9E1;
                            border-radius: 50%;
                            line-height: 5em;
                            float: left;
                        }

                        .progress-circle:after{
                            border: none;
                            position: absolute;
                            top: 0.35em;
                            left: 0.35em;
                            text-align: center;
                            display: block;
                            border-radius: 50%;
                            width: 4.3em;
                            height: 4.3em;
                            background-color: white;
                            content: " ";
                        }
                        /* Text inside the control */
                        .progress-circle span {
                            position: absolute;
                            line-height: 5em;
                            width: 5em;
                            text-align: center;
                            display: block;
                            color: #53777A;
                            z-index: 2;
                        }
                        .left-half-clipper {
                        /* a round circle */
                        border-radius: 50%;
                        width: 5em;
                        height: 5em;
                        position: absolute; /* needed for clipping */
                        clip: rect(0, 5em, 5em, 2.5em); /* clips the whole left half*/
                        }
                        /* when p>50, don't clip left half*/
                        .progress-circle.over50 .left-half-clipper {
                        clip: rect(auto,auto,auto,auto);
                        }
                        .value-bar {
                        /*This is an overlayed square, that is made round with the border radius,
                        then it is cut to display only the left half, then rotated clockwise
                        to escape the outer clipping path.*/
                        position: absolute; /*needed for clipping*/
                        clip: rect(0, 2.5em, 5em, 0);
                        width: 5em;
                        height: 5em;
                        border-radius: 50%;
                        border: 0.45em solid #ee4054; /*The border is 0.35 but making it larger removes visual artifacts */
                        /*background-color: #4D642D;*/ /* for debug */
                        box-sizing: border-box;

                        }
                        /* Progress bar filling the whole right half for values above 50% */
                        .progress-circle.over50 .first50-bar {
                        /*Progress bar for the first 50%, filling the whole right half*/
                        position: absolute; /*needed for clipping*/
                        clip: rect(0, 5em, 5em, 2.5em);
                        background-color: #ee4054;
                        border-radius: 50%;
                        width: 5em;
                        height: 5em;
                        }
                        .progress-circle:not(.over50) .first50-bar{ display: none; }


                        /* Progress bar rotation position */
                        .progress-circle.p0 .value-bar { display: none; }
                        .progress-circle.p1 .value-bar { transform: rotate(4deg); }
                        .progress-circle.p2 .value-bar { transform: rotate(7deg); }
                        .progress-circle.p3 .value-bar { transform: rotate(11deg); }
                        .progress-circle.p4 .value-bar { transform: rotate(14deg); }
                        .progress-circle.p5 .value-bar { transform: rotate(18deg); }
                        .progress-circle.p6 .value-bar { transform: rotate(22deg); }
                        .progress-circle.p7 .value-bar { transform: rotate(25deg); }
                        .progress-circle.p8 .value-bar { transform: rotate(29deg); }
                        .progress-circle.p9 .value-bar { transform: rotate(32deg); }
                        .progress-circle.p10 .value-bar { transform: rotate(36deg); }
                        .progress-circle.p11 .value-bar { transform: rotate(40deg); }
                        .progress-circle.p12 .value-bar { transform: rotate(43deg); }
                        .progress-circle.p13 .value-bar { transform: rotate(47deg); }
                        .progress-circle.p14 .value-bar { transform: rotate(50deg); }
                        .progress-circle.p15 .value-bar { transform: rotate(54deg); }
                        .progress-circle.p16 .value-bar { transform: rotate(58deg); }
                        .progress-circle.p17 .value-bar { transform: rotate(61deg); }
                        .progress-circle.p18 .value-bar { transform: rotate(65deg); }
                        .progress-circle.p19 .value-bar { transform: rotate(68deg); }
                        .progress-circle.p20 .value-bar { transform: rotate(72deg); }
                        .progress-circle.p21 .value-bar { transform: rotate(76deg); }
                        .progress-circle.p22 .value-bar { transform: rotate(79deg); }
                        .progress-circle.p23 .value-bar { transform: rotate(83deg); }
                        .progress-circle.p24 .value-bar { transform: rotate(86deg); }
                        .progress-circle.p25 .value-bar { transform: rotate(90deg); }
                        .progress-circle.p26 .value-bar { transform: rotate(94deg); }
                        .progress-circle.p27 .value-bar { transform: rotate(97deg); }
                        .progress-circle.p28 .value-bar { transform: rotate(101deg); }
                        .progress-circle.p29 .value-bar { transform: rotate(104deg); }
                        .progress-circle.p30 .value-bar { transform: rotate(108deg); }
                        .progress-circle.p31 .value-bar { transform: rotate(112deg); }
                        .progress-circle.p32 .value-bar { transform: rotate(115deg); }
                        .progress-circle.p33 .value-bar { transform: rotate(119deg); }
                        .progress-circle.p34 .value-bar { transform: rotate(122deg); }
                        .progress-circle.p35 .value-bar { transform: rotate(126deg); }
                        .progress-circle.p36 .value-bar { transform: rotate(130deg); }
                        .progress-circle.p37 .value-bar { transform: rotate(133deg); }
                        .progress-circle.p38 .value-bar { transform: rotate(137deg); }
                        .progress-circle.p39 .value-bar { transform: rotate(140deg); }
                        .progress-circle.p40 .value-bar { transform: rotate(144deg); }
                        .progress-circle.p41 .value-bar { transform: rotate(148deg); }
                        .progress-circle.p42 .value-bar { transform: rotate(151deg); }
                        .progress-circle.p43 .value-bar { transform: rotate(155deg); }
                        .progress-circle.p44 .value-bar { transform: rotate(158deg); }
                        .progress-circle.p45 .value-bar { transform: rotate(162deg); }
                        .progress-circle.p46 .value-bar { transform: rotate(166deg); }
                        .progress-circle.p47 .value-bar { transform: rotate(169deg); }
                        .progress-circle.p48 .value-bar { transform: rotate(173deg); }
                        .progress-circle.p49 .value-bar { transform: rotate(176deg); }
                        .progress-circle.p50 .value-bar { transform: rotate(180deg); }
                        .progress-circle.p51 .value-bar { transform: rotate(184deg); }
                        .progress-circle.p52 .value-bar { transform: rotate(187deg); }
                        .progress-circle.p53 .value-bar { transform: rotate(191deg); }
                        .progress-circle.p54 .value-bar { transform: rotate(194deg); }
                        .progress-circle.p55 .value-bar { transform: rotate(198deg); }
                        .progress-circle.p56 .value-bar { transform: rotate(202deg); }
                        .progress-circle.p57 .value-bar { transform: rotate(205deg); }
                        .progress-circle.p58 .value-bar { transform: rotate(209deg); }
                        .progress-circle.p59 .value-bar { transform: rotate(212deg); }
                        .progress-circle.p60 .value-bar { transform: rotate(216deg); }
                        .progress-circle.p61 .value-bar { transform: rotate(220deg); }
                        .progress-circle.p62 .value-bar { transform: rotate(223deg); }
                        .progress-circle.p63 .value-bar { transform: rotate(227deg); }
                        .progress-circle.p64 .value-bar { transform: rotate(230deg); }
                        .progress-circle.p65 .value-bar { transform: rotate(234deg); }
                        .progress-circle.p66 .value-bar { transform: rotate(238deg); }
                        .progress-circle.p67 .value-bar { transform: rotate(241deg); }
                        .progress-circle.p68 .value-bar { transform: rotate(245deg); }
                        .progress-circle.p69 .value-bar { transform: rotate(248deg); }
                        .progress-circle.p70 .value-bar { transform: rotate(252deg); }
                        .progress-circle.p71 .value-bar { transform: rotate(256deg); }
                        .progress-circle.p72 .value-bar { transform: rotate(259deg); }
                        .progress-circle.p73 .value-bar { transform: rotate(263deg); }
                        .progress-circle.p74 .value-bar { transform: rotate(266deg); }
                        .progress-circle.p75 .value-bar { transform: rotate(270deg); }
                        .progress-circle.p76 .value-bar { transform: rotate(274deg); }
                        .progress-circle.p77 .value-bar { transform: rotate(277deg); }
                        .progress-circle.p78 .value-bar { transform: rotate(281deg); }
                        .progress-circle.p79 .value-bar { transform: rotate(284deg); }
                        .progress-circle.p80 .value-bar { transform: rotate(288deg); }
                        .progress-circle.p81 .value-bar { transform: rotate(292deg); }
                        .progress-circle.p82 .value-bar { transform: rotate(295deg); }
                        .progress-circle.p83 .value-bar { transform: rotate(299deg); }
                        .progress-circle.p84 .value-bar { transform: rotate(302deg); }
                        .progress-circle.p85 .value-bar { transform: rotate(306deg); }
                        .progress-circle.p86 .value-bar { transform: rotate(310deg); }
                        .progress-circle.p87 .value-bar { transform: rotate(313deg); }
                        .progress-circle.p88 .value-bar { transform: rotate(317deg); }
                        .progress-circle.p89 .value-bar { transform: rotate(320deg); }
                        .progress-circle.p90 .value-bar { transform: rotate(324deg); }
                        .progress-circle.p91 .value-bar { transform: rotate(328deg); }
                        .progress-circle.p92 .value-bar { transform: rotate(331deg); }
                        .progress-circle.p93 .value-bar { transform: rotate(335deg); }
                        .progress-circle.p94 .value-bar { transform: rotate(338deg); }
                        .progress-circle.p95 .value-bar { transform: rotate(342deg); }
                        .progress-circle.p96 .value-bar { transform: rotate(346deg); }
                        .progress-circle.p97 .value-bar { transform: rotate(349deg); }
                        .progress-circle.p98 .value-bar { transform: rotate(353deg); }
                        .progress-circle.p99 .value-bar { transform: rotate(356deg); }
                        .progress-circle.p100 .value-bar { transform: rotate(360deg); }

                    </style>
                    <div class="row">
                        <div class="col-lg-5 d-flex">
                            <div class="row">
                                <div class="col mb-3 d-lg-block d-flex justify-content-center col-lg-3 col-md-3 col-sm-3">
                                        @if ($count != 0)
                                            @php
                                                $avg_rating =  $total_rating/$count
                                            @endphp
                                        @endif

                                    <div class="progress-circle me-4 over50
                                        @if($count != 0)
                                        @if($avg_rating == 1) p20
                                        @elseif($avg_rating == 1.1) p22
                                        @elseif($avg_rating == 1.2) p24
                                        @elseif($avg_rating == 1.3) p26
                                        @elseif($avg_rating == 1.4) p28
                                        @elseif($avg_rating == 1.5) p30
                                        @elseif($avg_rating == 1.6) p32
                                        @elseif($avg_rating == 1.7) p34
                                        @elseif($avg_rating == 1.8) p36
                                        @elseif($avg_rating == 1.9) p38
                                        @elseif($avg_rating == 2) p40
                                        @elseif($avg_rating == 2.1) p42
                                        @elseif($avg_rating == 2.2) p44
                                        @elseif($avg_rating == 2.3) p46
                                        @elseif($avg_rating == 2.4) p48
                                        @elseif($avg_rating == 2.5) p50
                                        @elseif($avg_rating == 2.6) p52
                                        @elseif($avg_rating == 2.7) p54
                                        @elseif($avg_rating == 2.8) p56
                                        @elseif($avg_rating == 2.9) p58
                                        @elseif($avg_rating == 3) p60
                                        @elseif($avg_rating == 3.1) p62
                                        @elseif($avg_rating == 3.2) p64
                                        @elseif($avg_rating == 3.3) p66
                                        @elseif($avg_rating == 3.4) p68
                                        @elseif($avg_rating == 3.5) p70
                                        @elseif($avg_rating == 3.6) p72
                                        @elseif($avg_rating == 3.7) p74
                                        @elseif($avg_rating == 3.8) p76
                                        @elseif($avg_rating == 3.9) p78
                                        @elseif($avg_rating == 4) p80
                                        @elseif($avg_rating == 4.1) p82
                                        @elseif($avg_rating == 4.2) p84
                                        @elseif($avg_rating == 4.3) p86
                                        @elseif($avg_rating == 4.4) p88
                                        @elseif($avg_rating == 4.5) p90
                                        @elseif($avg_rating == 4.6) p92
                                        @elseif($avg_rating == 4.7) p94
                                        @elseif($avg_rating == 4.8) p96
                                        @elseif($avg_rating == 4.9) p98
                                        @elseif($avg_rating == 5) p100
                                        @endif
                                        @endif
                                    ">
                                        <span class="text-theme">@if($count != 0){{ $avg_rating }}@endif <i class="fa fa-star" style="font-size: 15px;"> </i></span>
                                        <div class="left-half-clipper ">
                                           <div class="first50-bar"></div>
                                           <div class="value-bar"></div>
                                        </div>
                                     </div>
                                     {{-- <p>3434 ratings</p> --}}
                                </div>
                                <div class="col d-lg-block d-flex justify-content-center">
                                    @php

                                        $rating_5 = count_ratings([
                                            'ratings'=>5,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_4 = count_ratings([
                                            'ratings'=>4,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_3 = count_ratings([
                                            'ratings'=>3,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_2 = count_ratings([
                                            'ratings'=>2,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_1 = count_ratings([
                                            'ratings'=>1,
                                            'product_id'=>$product->id
                                            ]);
                                    @endphp
                                    <div class="ms-lg-3 ms-md-3 ms-sm-3 border-0">
                                        <div class="progress-bar--wrap progress-bar--green">
                                            <span class="progress-bar--counter text-dark">5 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width:
                                                @if(count($rating_5)!= 0)
                                                    @if(5/$count == 5)
                                                        100%
                                                    @elseif(5/$count >= 4.5)
                                                        90%
                                                    @elseif(5/$count >= 4)
                                                        80%
                                                    @elseif(5/$count >= 3.5)
                                                        70%
                                                    @elseif(5/$count >= 3)
                                                        60%
                                                    @elseif(5/$count >= 2.5)
                                                        50%
                                                    @elseif(5/$count >= 2)
                                                        40%
                                                    @elseif(5/$count >= 1.5)
                                                        30%
                                                    @elseif(5/$count >= 1)
                                                        20%
                                                    @elseif(5/$count >= 0.5)
                                                        10%
                                                    @elseif(5/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_5) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--blue">
                                            <span class="progress-bar--counter text-dark">4 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width:
                                                @if(count($rating_4)!= 0)
                                                    @if(4/$count == 5)
                                                        100%
                                                    @elseif(4/$count >= 4.5)
                                                        90%
                                                    @elseif(4/$count >= 4)
                                                        80%
                                                    @elseif(4/$count >= 3.5)
                                                        70%
                                                    @elseif(4/$count >= 3)
                                                        60%
                                                    @elseif(4/$count >= 2.5)
                                                        50%
                                                    @elseif(4/$count >= 2)
                                                        40%
                                                    @elseif(4/$count >= 1.5)
                                                        30%
                                                    @elseif(4/$count >= 1)
                                                        20%
                                                    @elseif(4/$count >= 0.5)
                                                        10%
                                                    @elseif(4/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_4) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--red">
                                            <span class="progress-bar--counter text-dark">3 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width:
                                                @if(count($rating_3)!= 0)
                                                    @if(3/$count == 5)
                                                        100%
                                                    @elseif(3/$count >= 4.5)
                                                        90%
                                                    @elseif(3/$count >= 4)
                                                        80%
                                                    @elseif(3/$count >= 3.5)
                                                        70%
                                                    @elseif(3/$count >= 3)
                                                        60%
                                                    @elseif(3/$count >= 2.5)
                                                        50%
                                                    @elseif(3/$count >= 2)
                                                        40%
                                                    @elseif(3/$count >= 1.5)
                                                        30%
                                                    @elseif(3/$count >= 1)
                                                        20%
                                                    @elseif(3/$count >= 0.5)
                                                        10%
                                                    @elseif(3/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_3) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--yellow">
                                            <span class="progress-bar--counter text-dark">2 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-warning" style="width:
                                                @if(count($rating_2)!= 0)
                                                    @if(2/$count == 5)
                                                        100%
                                                    @elseif(2/$count >= 4.5)
                                                        90%
                                                    @elseif(2/$count >= 4)
                                                        80%
                                                    @elseif(2/$count >= 3.5)
                                                        70%
                                                    @elseif(2/$count >= 3)
                                                        60%
                                                    @elseif(2/$count >= 2.5)
                                                        50%
                                                    @elseif(2/$count >= 2)
                                                        40%
                                                    @elseif(2/$count >= 1.5)
                                                        30%
                                                    @elseif(2/$count >= 1)
                                                        20%
                                                    @elseif(2/$count >= 0.5)
                                                        10%
                                                    @elseif(2/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_2) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--yellow">
                                            <span class="progress-bar--counter text-dark">1 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-danger" style="width:
                                                @if(count($rating_1)!= 0)
                                                    @if(1/$count == 5)
                                                        100%
                                                    @elseif(1/$count >= 4.5)
                                                        90%
                                                    @elseif(1/$count >= 4)
                                                        80%
                                                    @elseif(1/$count >= 3.5)
                                                        70%
                                                    @elseif(1/$count >= 3)
                                                        60%
                                                    @elseif(1/$count >= 2.5)
                                                        50%
                                                    @elseif(1/$count >= 2)
                                                        40%
                                                    @elseif(1/$count >= 1.5)
                                                        30%
                                                    @elseif(1/$count >= 1)
                                                        20%
                                                    @elseif(1/$count >= 0.5)
                                                        10%
                                                    @elseif(1/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            @php
                                $rating_data = count_ratings(['product_id'=>$product->id])
                            @endphp
                            @foreach ($rating_data as $rd)
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <h6><span class="badge bg-success">{{ $rd->ratings }} <i class="fa fa-star" style="font-size: 9px;"></i></span> <span class="small fw-bold ms-3">{{ $rd->review_title }}!</span></h6>
                                    <p class="fw-bold small">{{ $rd->body }}</p>
                                    <p class="small fw-bold text-muted">{{ $rd->user->user_name }} | on {{ date('d M Y ',strtotime($rd->created_at)) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
               <h4 class="text-center h5 mb-4">No rating and reviews yet!</h4>
            @endif
