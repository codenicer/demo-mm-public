<style>
   
    #ru-container .btn-grey{
        background-color:#D8D8D8;
        color:#FFF;
    }
    #ru-container  .rating-block{
        background-color:#ffffff;
        border:1px solid #EFEFEF;
        padding:15px 15px 20px 15px;
        border-radius:3px;
    }
    #ru-container  .bold{
        font-weight:700;
    }
    #ru-container  .padding-bottom-7{
        padding-bottom:7px;
    }
    #ru-container  .review-block{
        background-color:#ffffff;
        border:1px solid #EFEFEF;
        padding:15px;
        border-radius:3px;
        margin-bottom:15px;
    }
    #ru-container  .review-block-name{
        font-size:12px;
        margin:10px 0;
    }
    #ru-container  .review-block-date{
        font-size:12px;
    }
    #ru-container  .review-block-rate{
        font-size:13px;
        margin-bottom:15px;
    }
    #ru-container  .review-block-title{
        font-size:15px;
        font-weight:700;
        margin-bottom:10px;
    }
    #ru-container  .review-block-description{
        font-size:13px;
    }
</style>

<div id="ru-container">
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-5 col-md-6 p-0">
            <div class="rating-block">
                <h4>Average user rating</h4>
                <h2 class="bold padding-bottom-7">{{$averageInfo['average']}}<small>/ 5</small></h2>
                <div class="star-rating" style='font-size: 1.5rem;'>
                  {{ renderStarRating($averageInfo['average']) }}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 col-md-6 d-flex flex-column  p-0">
            <div class="d-flex flex-column px-3">
                <h4>Rating breakdown</h4>
                <div class="d-flex align-items-center">
                    <div class='mr-2' style="width:85px line-height:1;">
                        <div class="star-rating">
                            {{ renderStarRating(5) }}
                        </div>
                    </div>
                    <div class="pull-left flex-grow-1">
                        <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar" role="progressbar" aria-valuenow='4' aria-valuemin="0" aria-valuemax="5" 
                            style="width:{{($reviews_count && $averageInfo['fiveStars']) ? ($averageInfo['fiveStars']/$reviews_count)*100 : 0}}%; background-color: #fc0">
                            <span class="sr-only"></span>
                        </div>
                        </div>
                    </div>
                <div class="pull-right" style="width: 30px; margin-left:10px;">{{$averageInfo['fiveStars']}}</div>
                </div>
                <div class="d-flex align-items-center">
                    <div class='mr-2' style="width:85px line-height:1;">
                        <div class="star-rating">
                            {{ renderStarRating(4) }}
                        </div>
                    </div>
                    <div class="pull-left flex-grow-1">
                        <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" 
                        style="width:{{($reviews_count  && $averageInfo['fourStars'] ) ? ($averageInfo['fourStars']/$reviews_count)*100 : 0}}%; background-color: #fc0">
                            <span class="sr-only"></span>
                        </div>
                        </div>
                    </div>
                    <div class="pull-right" style="width: 30px; margin-left:10px;">{{$averageInfo['fourStars']}} </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class='mr-2' style="width:85px line-height:1;">
                        <div class="star-rating">
                            {{ renderStarRating(3) }}
                        </div>
                    </div>
                    <div class="pull-left flex-grow-1">
                        <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" 
                            style="width:{{($reviews_count  && $averageInfo['threeStars'] ) ? ($averageInfo['threeStars']/$reviews_count)*100 : 00}}%; background-color: #fc0">
                            <span class="sr-only"></span>
                        </div>
                        </div>
                    </div>
                    <div class="pull-right" style="width: 30px; margin-left:10px;">{{$averageInfo['threeStars']}} </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class='mr-2' style="width:85px line-height:1;">
                        <div class="star-rating">
                            {{ renderStarRating(2) }}
                        </div>
                    </div>
                    <div class="pull-left flex-grow-1">
                        <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"
                            style="width:{{($reviews_count  && $averageInfo['twoStars'] ) ? ($averageInfo['twoStars']/$reviews_count)*100 : 0}}%; background-color: #fc0">
                            <span class="sr-only"> </span>
                        </div>
                        </div>
                    </div>
                    <div class="pull-right" style="width: 30px; margin-left:10px;">{{$averageInfo['twoStars']}}</div>
                </div>
                <div class="d-flex align-items-center">
                    <div class='mr-2' style="width:85px line-height:1;">
                        <div class="star-rating">
                            {{ renderStarRating(1) }}
                        </div>
                    </div>
                    <div class="pull-left flex-grow-1">
                        <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" 
                            style="width:{{($reviews_count  && $averageInfo['oneStars'] ) ? ($averageInfo['oneStars']/$reviews_count)*100 : 0}}%; background-color: #fc0">
                            <span class="sr-only"></span>
                        </div>
                        </div>
                    </div>
                    <div class="pull-right" style="width: 30px; margin-left:10px;">{{$averageInfo['oneStars']}}</div>
                </div>
            </div>
        </div>			
    </div>			
    
 
</div>
</div> <!-- /container -->

<script>
   
    $("#r-viewall").click(function(){
        $('#r-viewall').text('Please wait...');
       $.ajax({
           type:"get",
           url:'{{url('/product/reviews/'.$id)}}',
           success: function(data){
                   $('#review-block').html(data)
          }
       })
    })
 
 </script>